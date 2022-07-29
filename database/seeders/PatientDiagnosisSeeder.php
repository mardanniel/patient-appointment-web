<?php

namespace Database\Seeders;

use App\Models\PatientDiagnosis;
use Illuminate\Database\Seeder;

class PatientDiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PatientDiagnosis::factory(1000)->create();
    }
}
