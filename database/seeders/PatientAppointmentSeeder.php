<?php

namespace Database\Seeders;

use App\Models\PatientAppointment;
use Illuminate\Database\Seeder;

class PatientAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // old = 1000
        PatientAppointment::factory(2000)->create();
    }
}
