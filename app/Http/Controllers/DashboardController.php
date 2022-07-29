<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function patientDashboard(){

        $appointments = DB::table('patient_appointments')
                            ->select(DB::raw('count(*) as appointment_count, is_done'))
                            ->where('patient_id', '=', Auth::id())
                            ->groupBy('is_done')
                            ->get();

        $notDoneCount = (isset($appointments[0]) ? $appointments[0]->appointment_count : 0);
        $doneCount = (isset($appointments[1]) ? $appointments[1]->appointment_count : 0);

        $counts = [
            'total_appointments' => $doneCount + $notDoneCount,
            'unsettled_appointments' => $notDoneCount,
            'settled_appointments' => $doneCount,
        ];

        $randomExpertise = [
            'Allergists',
            'Cardiologists',
            'Dermatologists',
            'Endocrinologists',
            'Physicians',
            'Gastroenterologists',
            'Nephrologists',
            'Neurologists',
            'Gynecologists',
            'Pediatricians',
            'Psychiatrists'
        ];
        
        return view('patient.dashboard', compact(['counts', 'randomExpertise']));
    }

    public function randomDoctor(Request $request){

        $expertiseKey = $request->input('expertise');

        $doctors = Doctor::inRandomOrder()
                            ->when($request->get('expertise'), function($query, $expertiseKey){

                                $expertiseList = [
                                    'Allergists',
                                    'Cardiologists',
                                    'Dermatologists',
                                    'Endocrinologists',
                                    'Physicians',
                                    'Gastroenterologists',
                                    'Nephrologists',
                                    'Neurologists',
                                    'Gynecologists',
                                    'Pediatricians',
                                    'Psychiatrists'
                                ];

                                return array_key_exists($expertiseKey, $expertiseList) 
                                        ? $query->where('expertise', $expertiseList[$expertiseKey])
                                        : null;

                            })
                            ->paginate(20);

        return response()->json([
            'doctors' => $doctors,
            'links' => (string) $doctors->links()
        ]);

    }
    
    public function adminDashboard(){

        $entitiesCount = DB::select(
            DB::raw("SELECT (SELECT COUNT(*) FROM patients) as patients_count, 
                            (SELECT COUNT(*) FROM doctors) as doctors_count, 
                            (SELECT COUNT(*) FROM patient_appointments) as appointments_count,
                            (SELECT COUNT(*) FROM patient_diagnoses) as patient_diagnosis_count,
                            (SELECT COUNT(*) FROM doctor_schedules) as doctor_schedules_count")
        );

        $appointmentAverageDivisor = 5;

        $appointmentsPerYear = DB::table('patient_appointments')
            ->selectRaw("count(*) AS data, YEAR(sched_at) AS year")
            ->groupBy('year')
            ->orderBy('year', 'DESC')
            ->limit($appointmentAverageDivisor)
            ->get()
            ->toArray();

        $averageAppointmentsPerYear = array_sum(
                            array_column($appointmentsPerYear, 'data')
                        ) / $appointmentAverageDivisor;

        return view('admin.dashboard', compact(
                'entitiesCount', 
                'appointmentsPerYear', 
                'averageAppointmentsPerYear',
                'appointmentAverageDivisor'
            )
        );

    }
}
