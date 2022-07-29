<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
            'fname' => $this->faker->firstName(),
            'mname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'gender' => '0',
            'dob' => '2014-08-01',
            'contact_num' => '9664544777',
            'street' => 'Voluptatum quidem co',
            'barangay' => 'Illo in occaecat rer',
            'city' => 'Laborum obcaecati sa',
        ];
    }
}
