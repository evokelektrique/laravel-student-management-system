<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder {
    public function run() {
        \App\Models\Student::factory(10)->create()->each(function ($student) {
            $student->user()->associate(\App\Models\User::factory()->create());
            $student->save();
        });
    }
}
