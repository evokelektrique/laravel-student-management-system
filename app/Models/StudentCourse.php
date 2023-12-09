<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model {
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'semester_number', 'course_group_id', 'grade',
        // Add other pivot table fields as needed
    ];

    // Add relationships if needed
    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
