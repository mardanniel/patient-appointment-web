<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use App\Models\PatientAppointment;
use App\Models\PatientDiagnosis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (!Patient::where('email', 'namibibes@gmail.com')->exists()){

            Patient::create([
                'fname' => 'Dieter',
                'mname' => 'Malik Oneal',
                'lname' => 'Lott',
                'email' => 'namibibes@gmail.com',
                'password' => '$2y$10$PdoXvZ.uQAZppUpt4qkbs.kGPK5oriTuR4.ozJVvUqjJW6nS.Np2K',
                'gender' => '0',
                'dob' => '2014-08-01',
                'contact_num' => '9664544777',
                'street' => 'Voluptatum quidem co',
                'barangay' => 'Illo in occaecat rer',
                'city' => 'Laborum obcaecati sa',
                'email_verified_at' => '2022-03-01 00:56:59'
            ]);
            
        }

        if (!Admin::where('email', 'marmallowzmallowz@gmail.com')->exists()){

            Admin::create([
                'fname' => 'Dieter',
                'mname' => 'Malik Oneal',
                'lname' => 'Lott',
                'email' => 'marmallowzmallowz@gmail.com',
                'password' => '$2y$10$PdoXvZ.uQAZppUpt4qkbs.kGPK5oriTuR4.ozJVvUqjJW6nS.Np2K',
            ]);
            
        }
        
        $this->call(PatientSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(DoctorScheduleSeeder::class);
        $this->call(PatientAppointmentSeeder::class);
        $this->call(PatientDiagnosisSeeder::class);

        DB::select('UPDATE patient_appointments, patient_diagnoses 
                    SET patient_appointments.is_done = 1 
                    WHERE patient_appointments.id = patient_diagnoses.pa_id 
                    AND patient_appointments.patient_id = patient_diagnoses.patient_id 
                    AND patient_appointments.doctor_id = patient_diagnoses.doctor_id');

    }
}
