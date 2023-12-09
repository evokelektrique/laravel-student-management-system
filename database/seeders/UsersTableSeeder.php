<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::firstOrCreate(
            [
                'email'    => env('INITIAL_USER_EMAIL'),
            ],
            [
                'name'     => env('INITIAL_USER_NAME'),
                'email'    => env('INITIAL_USER_EMAIL'),
                'password' => Hash::make(env('INITIAL_USER_PASSWORD')),
                'is_admin' => true,
                'is_student' => false,
                'student_number' => 0,
            ]
        );
    }
}
