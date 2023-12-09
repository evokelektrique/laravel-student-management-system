<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model {
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'department_id',
        'semester_number',
        'course_group_id',
        'course_type',
        'course_status',
        'course_number_of_units',
        // Add other course-related fields as needed
    ];

    public function students() {
        return $this->belongsToMany(Student::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
