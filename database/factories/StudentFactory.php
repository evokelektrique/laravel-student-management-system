<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory {
    protected $model = Student::class;

    public function definition() {
        return [
            'student_number' => $this->faker->unique()->numerify('###########'),
            'full_name' => $this->faker->name,
            'department_id' => Department::factory(),
            'education_level' => $this->faker->randomElement(['کارشناسی', 'کارشناسی ارشد', 'دکتری']),
            'user_id' => User::factory(),
            // Add the new columns
        ];
    }
}
