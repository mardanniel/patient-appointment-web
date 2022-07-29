<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\DoctorSchedule\CreateOrUpdateScheduleRequest;
use App\Http\Requests\DoctorSchedule\RemoveScheduleRequest;
use App\Http\Requests\PatientRecordRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorSchedule;
use App\Models\PatientAppointment;
use App\Models\PatientDiagnosis;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    public function loginForm(){

        return view('doctor.auth.login');
    }

    public function authenticate(LoginRequest $request){

        $request->authenticate('doctor');

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::DOCTOR_HOME);

    }

    public function viewAppointments(){

        $appointments = DB::table('patient_appointments')
                            ->where('patient_appointments.doctor_id', Auth::id())
                            ->where('patient_appointments.is_done', 0)
                            ->orderBy('patient_appointments.sched_at', 'DESC')
                            ->join('patients', 'patient_appointments.patient_id', '=', 'patients.id')
                            ->select('patient_appointments.*', 'patients.fname', 'patients.mname', 'patients.lname')
                            ->paginate(10);

        return view('doctor.appointment.list', compact('appointments'));

    }

    public function viewAppointment($appointment_id){

        if(is_int($appointment_id)){

            return redirect()->route('doctor.appointments')
                             ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');
        }

        $appointment = DB::table('patient_appointments as pa')
                                ->where('pa.doctor_id', Auth::id())
                                ->where('pa.id', $appointment_id)
                                ->join('patients', 'pa.patient_id', '=', 'patients.id')
                                ->select('pa.*', 'patients.fname', 'patients.mname', 'patients.lname')
                                ->get();

        if(!count($appointment)){

            return redirect()->route('doctor.appointments')
                             ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }

        return view('doctor.appointment.show', compact('appointment'));

    }

    public function viewSchedules(){

        $schedules = DB::table('doctor_schedules')
                            ->where('doctor_id', Auth::id())
                            ->orderBy('sched_time_start')
                            ->get()
                            ->groupBy('sched_day')
                            ->toArray();

        $daysOfTheWeek = [
            "Sunday" => null,
            "Monday" => null,
            "Tuesday" => null,
            "Wednesday" => null,
            "Thursday" => null,
            "Friday" => null,
            "Saturday" => null,
        ];

        $schedule_keys = array_keys($schedules);

        foreach ($daysOfTheWeek as $key => $val) {
            $search_key = array_search($key, $schedule_keys);
            if($search_key !== FALSE){
                $daysOfTheWeek[$key] = $schedules[$key];
            }else{
                unset($daysOfTheWeek[$key]);
            }
        }
        
        return view('doctor.schedule.list')->with('schedules', $daysOfTheWeek);

    }

    public function editSchedule($sched_id){

        try {

            $doctor_sched = DoctorSchedule::where('doctor_id', Auth::id())
                                                ->findOrFail($sched_id);

            $daysOfTheWeek = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday"
            ];

            $doctor_sched->sched_day = array_search($doctor_sched->sched_day, $daysOfTheWeek);

            return view('doctor.schedule.edit', compact('doctor_sched'));

        } catch (ModelNotFoundException $e) {

            return redirect()->route('doctor.schedules')
                             ->with('error', 'Seems like we can\'t find the schedule that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }

    }

    
    public function updateSchedule(CreateOrUpdateScheduleRequest $request){

        try {
            $doctor_sched = Auth::user()->schedule()->find($request->id);

            $doctor_sched->sched_time_start = $request->sched_time_start;

            $doctor_sched->sched_time_end = $request->sched_time_end;

            $doctor_sched->save();

            return redirect()
                    ->route('doctor.schedules')
                    ->with('success', 'Successfully updated a schedule! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');

        } catch (ModelNotFoundException $e) {

            return redirect()->route('doctor.schedules')
                             ->with('error', 'Seems like we can\'t find the schedule that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }

    }
    
    public function createSchedule(){
        
        return view('doctor.schedule.create');
        
    }
    
    public function storeSchedule(CreateOrUpdateScheduleRequest $request){
        
        $validatedInput = $request->validated();

        $daysOfTheWeek = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];

        Auth::user()->schedule()->create([
            'sched_day' => $daysOfTheWeek[intval($validatedInput['sched_day'])],
            'sched_time_start' => $validatedInput['sched_time_start'],
            'sched_time_end' => $validatedInput['sched_time_end'],
        ]);
        
        return redirect()
            ->route('doctor.schedules')
            ->with('success', 'Successfully created a schedule! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');
        
    }
    
    public function removeSchedule(RemoveScheduleRequest $request){

        $validated = $request->validated();

        Auth::user()->schedule()->find($validated['id'])->delete();

        return redirect()
                ->route('doctor.schedules')
                ->with('success', 'Successfully deleted a schedule! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');

    }

    public function viewPatientRecords(){      

        return view('doctor.patient-record.list');

    }

    public function getPatientRecords(Request $request){

        $q = strtolower(
            ctype_alpha($request->input('q')) 
            ? $request->input('q') 
            : ''
        );

        $patient_records = DB::table('patients as p')
                                ->selectRaw('p.id, p.fname, p.mname, p.lname, COUNT(pd.patient_id) as pd_count')
                                ->leftJoin('patient_diagnoses as pd', function($join){
                                    $join->on('p.id', '=', 'pd.patient_id')->where('pd.doctor_id', Auth::id());
                                })
                                ->when($q, function($query, $q){
                                    return $query->where(DB::raw('CONCAT(p.fname, " ", p.mname, " ", p.lname)'), 'like', '%'.strip_tags($q).'%');
                                })
                                ->havingRaw('COUNT(pd.patient_id) > 0')
                                ->groupBy('pd.patient_id')
                                ->paginate(20);
        
        
        return response()->json([
            'patient_records' => $patient_records,
            'links' => (string) $patient_records->links()
        ]);
    }

    public function viewPatientRecord($patient_id){

        $patient_record = DB::table('patient_diagnoses')
                                ->where('patient_diagnoses.patient_id', $patient_id)
                                ->where('patient_diagnoses.doctor_id', Auth::id())
                                ->join('patients', 'patient_diagnoses.patient_id', '=', 'patients.id')
                                ->selectRaw("patient_diagnoses.*, CONCAT(patients.fname,' ', patients.mname,' ', patients.lname) as patient_name")
                                ->orderBy('patient_diagnoses.created_at', 'ASC')
                                ->paginate(20);

        return view('doctor.patient-record.show', compact('patient_record'));
    }

    public function createPatientRecord($appointment_id){

        if(is_int(strip_tags($appointment_id))){

            return redirect()->route('doctor.appointments')
                             ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }

        $patient = DB::table('patient_appointments as pa')
                                ->where('pa.doctor_id', Auth::id())
                                ->where('pa.id', $appointment_id)
                                ->join('patients', 'pa.patient_id', '=', 'patients.id')
                                ->select('pa.id', 'pa.patient_id', 'patients.fname', 'patients.mname', 'patients.lname')
                                ->get();

        if(!count($patient)){

            return redirect()->route('doctor.appointments')
                             ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }

        return view('doctor.patient-record.create', compact('patient'));

    }

    public function storePatientRecord(PatientRecordRequest $request){

        try {

            PatientDiagnosis::create([
                'patient_id' => $request->patient_id,
                'pa_id' => $request->appointment_id,
                'doctor_id' => Auth::id(),
                'diagnosis' => $request->diagnosis,
                'temp' => $request->temp,
                'bp' => $request->bp,
                'weight' => $request->weight,
                'height' => $request->height,
                'pulse_rate' => $request->pulse_rate,
            ]);

            $patient_appointment = PatientAppointment::find($request->appointment_id);

            $patient_appointment->is_done = 1;

            $patient_appointment->save();

            return redirect()
                ->route('doctor.appointments')
                ->with('success_pr', 'Successfully created a patient record! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');

        }catch(ModelNotFoundException $e){

            return redirect()
                    ->route('doctor.appointments')
                    ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }

    }

    public function logout(Request $request){

        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('doctor.login');

    }
}
