<?php

namespace Database\Factories;

use App\Models\PatientAppointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientAppointmentFactory extends Factory
{
    protected $model = PatientAppointment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sched_at' => $this->faker->dateTime(),
            'concern' => $this->faker->sentence(),
            'is_done' => 0,
            'patient_id' => rand(1, 200),
            'doctor_id' => rand(1, 200)
        ];
    }
}
