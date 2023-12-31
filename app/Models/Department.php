<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        // Add other department-related fields as needed
    ];

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
