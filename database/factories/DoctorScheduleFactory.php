<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $base_start_time = $this->faker->time('H:i');
        $end_time = date("H:i", strtotime('+2 hours', strtotime($base_start_time))); 

        return [
            'doctor_id' => rand(1, 200),
            'sched_day' => $this->faker->dayOfWeek(),
            'sched_time_start' => $base_start_time,
            'sched_time_end' => $end_time,
        ];
    }
}
