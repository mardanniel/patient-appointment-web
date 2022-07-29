<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientAppointment;
use App\Models\PatientDiagnosis;
use App\Rules\ScheduleOverlap;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Appointment extends Controller
{
    
    public function index()
    {
        return view('patient.appointment.index');
    }

    public function list(Request $request){

        $validated = $request->validate([
            'is_settled' => [
                'between:0,1',
                'integer'
            ],
        ]);

        $appointments = DB::table('patient_appointments as pa')
                            ->where('pa.patient_id', Auth::id())
                            ->where('pa.is_done', $validated['is_settled'])
                            ->orderBy('sched_at','DESC')
                            ->join('doctors as d', 'pa.doctor_id', '=', 'd.id')
                            ->select('d.fname', 'd.mname','d.lname', 'pa.*')
                            ->paginate(20)
                            ->appends(['is_settled' => $validated['is_settled']]);


        return response()->json([
            'appointments' => $appointments,
            'links' => (string) $appointments->links()
        ]);
        
    }

    public function create($doctor_id)
    {
        try {

            $doctor = Doctor::with('schedule')->whereHas('schedule', function (Builder $query) use ($doctor_id){

                $query->where('doctor_id', $doctor_id);

            })->first();

            $doctor->schedule = $doctor->schedule
                                        ->sortBy('sched_time_start')
                                        ->groupBy('sched_day');

            $daysOfTheWeek = [
                "Sunday" => null,
                "Monday" => null,
                "Tuesday" => null,
                "Wednesday" => null,
                "Thursday" => null,
                "Friday" => null,
                "Saturday" => null,
            ];
    
            $schedule_keys = array_keys($doctor->schedule->toArray());
    
            foreach ($daysOfTheWeek as $key => $val) {
                $search_key = array_search($key, $schedule_keys);
                if($search_key !== FALSE){
                    $daysOfTheWeek[$key] = $doctor->schedule[$key];
                }else{
                    unset($daysOfTheWeek[$key]);
                }
            }

            $doctor->schedule = $daysOfTheWeek;
            
            return view('patient.appointment.create', compact('doctor'));

        }catch(ModelNotFoundException $e){

            return back()->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }
        
    }

    public function store(AppointmentRequest $request)
    {
        try {

            PatientAppointment::create([
                'sched_at' => $request->input('sched_at'),
                'doctor_id' => $request->input('doctor_id'),
                'concern' => $request->input('concern'),
                'patient_id' => Auth::id()
            ]);

            return redirect()
                    ->route('patient.appointment.index')
                    ->with('success', 'Successfully created an appointment with a doctor! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');

        }catch(ModelNotFoundException $e){

            return redirect()
                    ->route('patient.dashboard')
                    ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }
    }

    public function show($id)
    {
        try {

            $appointment = PatientAppointment::with('doctor')
                                                ->where('id', $id)
                                                ->where('patient_id', '=', Auth::id())
                                                ->firstOrFail();

            return view('patient.appointment.show', compact('appointment'));

        }catch(ModelNotFoundException $e){

            return back()->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');

        }
        
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => [
                'required',
                'integer',
                'exists:patient_appointments,id'
            ]
        ]);

        try {

            $appointment = Auth::user()->appointments()->findOrFail($validated['appointment_id']);

            $appointment->delete();

            return redirect()
                    ->route('patient.appointment.index')
                    ->with('success', 'Successfully cancelled an appointment! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');

        }catch(ModelNotFoundException $e){

            return redirect()
                    ->route('patient.dashboard')
                    ->with('error', 'Seems like we can\'t find the appointment that you are looking for. ¯\_( ͡° ͜ʖ ͡°)_/¯');
                    
        }
    }
}
