<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder {
    public function run() {
        \App\Models\Department::factory(5)->create();
    }
}
