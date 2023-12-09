<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentCourseFactory extends Factory
{
    protected $model = StudentCourse::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            // Add the new columns
            'semester_number' => $this->faker->randomDigit,
            'course_group_id' => $this->faker->word,
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'F']),
        ];
    }
}
