<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class AllDataImport implements ToCollection {
    public function collection(Collection $rows) {
        foreach ($rows->slice(1) as $row) {
            if(empty($row[0])) {
                continue;
            }

            // Import Users
            $user = User::firstOrCreate(
                ['email' => "default_{$row[0]}@email.com"], // Assuming 'email' is a unique field
                [
                    'student_number' => $row[0],
                    'name' => $row[1],
                    'password' => Hash::make('123456'),
                    // Add other user-related fields as needed
                ]
            );

            // Import Departments
            $department = Department::firstOrCreate(
                ['name' => $row[3]], // Assuming 'دانشکده' is a unique field
                [
                    // Add other department-related fields as needed
                ]
            );

            // Import Students
            $student = Student::firstOrCreate(
                ['student_number' => $row[0]], // Assuming 'student_number' is a unique field
                [
                    'full_name' => $row[1],
                    'user_id' => $user->id,
                    'education_level' => $row[4],
                    'department_id' => $department->id,
                    // Add other student-related fields as needed
                ]
            );

            // Import Courses
            $course = Course::firstOrCreate(
                ['course_code' => $row[11]], // Assuming 'course_code' is a unique field
                [
                    'course_name' => $row[12],
                    'department_id' => $department->id,
                    'semester_number' => $row[10],
                    'course_group_id' => $row[11],
                    'course_type' => $row[14],
                    'course_status' => $row[15],
                    'course_number_of_units' => $row[13],
                    // Add other course-related fields as needed
                ]
            );

            // Import StudentCourses
            $studentCourse = StudentCourse::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'semester_number' => $row[10],
                    'course_group_id' => $row[11],
                ], // Assuming a combination of 'student_id', 'course_id', 'semester_number', and 'course_group_id' is unique
                [
                    'grade' => $row[17],
                    // Add other pivot table fields as needed
                ]
            );
        }
    }
}
