<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory {
    protected $model = Course::class;

    public function definition() {
        return [
            'course_code' => $this->faker->unique()->numerify('##########'),
            'course_name' => $this->faker->words(3, true),
            'department_id' => Department::factory(),
            // Add the new columns
            'semester_number' => $this->faker->randomDigit,
            'course_group_id' => $this->faker->word,
            'course_type' => $this->faker->randomElement(['انتخابی', 'اجباری']),
            'course_status' => $this->faker->randomElement(['فعال', 'غیرفعال']),
            'course_number_of_units' => $this->faker->randomDigit,
        ];
    }
}
