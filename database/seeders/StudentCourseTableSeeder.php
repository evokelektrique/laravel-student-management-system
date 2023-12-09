<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentCourseTableSeeder extends Seeder {
    public function run() {
        \App\Models\StudentCourse::factory(20)->create();
    }
}
