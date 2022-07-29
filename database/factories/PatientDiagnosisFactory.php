<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PatientDiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomPatientAppointmentID = rand(1, 1000);

        $basePatientAppointment = DB::table('patient_appointments')
            ->select('patient_id', 'doctor_id')
            ->where('id', $randomPatientAppointmentID)
            ->get();

        return [
            'patient_id' => $basePatientAppointment[0]->patient_id,
            'doctor_id' => $basePatientAppointment[0]->doctor_id,
            'pa_id' => $randomPatientAppointmentID,
            'diagnosis' => $this->faker->sentence(20, true),
            'temp' => rand(39, 42),
            'bp' => rand(80, 129),
            'weight' => rand(55, 100),
            'height' => rand(150, 190),
            'pulse_rate' => rand(80, 129),
        ];
    }
}
