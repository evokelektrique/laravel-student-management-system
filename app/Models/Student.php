<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Student extends Model {
    use HasFactory;

    protected $fillable = [
        'student_number', 'full_name', 'user_id', 'department_id', 'education_level',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id')
            ->withPivot(['semester_number', 'course_group_id', 'grade'])
            ->withTimestamps();
    }

    public function coursesByType(string $type): Collection {
        return $this->courses()->where('course_type', $type)->get();
    }

    public function hasPassedAllCoursesByType(array $desiredCourseNames): bool {
        $passedCoursesCount = $this->courses()
            ->whereIn('course_name', $desiredCourseNames)
            ->count();

        return $passedCoursesCount === count($desiredCourseNames);
    }

    public function hasPassedCourse(string $courseName): bool {
        return $this->courses()
            ->where('course_name', $courseName)
            ->exists();
    }

    public function hasPassedCoursesByMinimumUnits(int $minimumTotalUnits, string $desiredCourseType): bool {
        $totalUnits = $this->courses()
            ->where('course_type', $desiredCourseType)
            ->selectRaw('SUM(course_number_of_units) as total_units')
            ->groupBy('student_courses.student_id')
            ->pluck('total_units')
            ->first();

        return $totalUnits >= $minimumTotalUnits;
    }
}
