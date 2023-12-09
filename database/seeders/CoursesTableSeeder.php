<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder {
    public function run() {
        \App\Models\Course::factory(10)->create();
    }
}
