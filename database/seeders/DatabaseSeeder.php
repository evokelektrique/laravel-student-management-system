<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\CoursesTableSeeder;
use Database\Seeders\StudentsTableSeeder;
use Database\Seeders\DepartmentsTableSeeder;
use Database\Seeders\StudentCourseTableSeeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UsersTableSeeder::class,
            DepartmentsTableSeeder::class,
            StudentsTableSeeder::class,
            CoursesTableSeeder::class,
            StudentCourseTableSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
