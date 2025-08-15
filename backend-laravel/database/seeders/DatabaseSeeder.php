<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserEducation;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $institutions = [
            'elementary' => ['Lincoln Elementary', 'Washington Elementary', 'Roosevelt Elementary'],
            'middle_school' => ['Jefferson Middle School', 'Adams Middle School', 'Jackson Middle School'],
            'high_school' => ['Central High School', 'East High School', 'West High School'],
            'diploma' => ['City Community College', 'State Technical Institute'],
            'bachelor' => ['University of California', 'Stanford University', 'MIT', 'Harvard University'],
            'master' => ['Stanford University', 'MIT', 'Harvard University', 'Yale University'],
            'doctorate' => ['Harvard University', 'MIT', 'Stanford University', 'Princeton University']
        ];

        $majors = [
            'Computer Science', 'Engineering', 'Business Administration', 'Psychology', 
            'Biology', 'Chemistry', 'Physics', 'Mathematics', 'English Literature',
            'Economics', 'Political Science', 'Art History', 'Medicine', 'Law'
        ];

        // Create 10 users
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'fullname' => fake()->name(),
                'gender' => fake()->randomElement(['male', 'female', 'other']),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'username' => fake()->unique()->userName(),
                'password' => Hash::make('password123'),
            ]);

            // Create 2-5 education records for each user
            $educationCount = rand(2, 5);
            $levels = ['elementary', 'middle_school', 'high_school', 'diploma', 'bachelor'];
            
            // Add master/doctorate sometimes
            if (rand(1, 10) > 6) {
                $levels[] = 'master';
            }
            if (rand(1, 10) > 8) {
                $levels[] = 'doctorate';
            }

            $currentYear = date('Y');
            $startYear = $currentYear - 25; // Start from 25 years ago

            for ($j = 0; $j < $educationCount && $j < count($levels); $j++) {
                $level = $levels[$j];
                $year = $startYear + ($j * 4); // Space out education by ~4 years
                
                UserEducation::create([
                    'user_id' => $user->id,
                    'level' => $level,
                    'year' => $year,
                    'institution' => fake()->randomElement($institutions[$level]),
                    'major' => in_array($level, ['diploma', 'bachelor', 'master', 'doctorate']) ? 
                              fake()->randomElement($majors) : null,
                    'gpa' => in_array($level, ['high_school', 'diploma', 'bachelor', 'master', 'doctorate']) ? 
                            fake()->randomFloat(2, 2.0, 4.0) : null,
                ]);
            }
        }
    }
}