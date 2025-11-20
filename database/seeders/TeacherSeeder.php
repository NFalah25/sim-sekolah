<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = [
            [
                'name' => 'John Doe',
                'position' => 'Mathematics Teacher',
                'email' => 'johndoe@gmail.com',
                'motivation' => 'Keep pushing forward!',
                'phone' => '123-456-7890',
                'NIP' => '1987654321',
                'linkGdrive' => 'https://drive.google.com/johndoe',
            ],
            [
                'name' => 'Jane Smith',
                'position' => 'Science Teacher',
                'email' => 'janesmith@gmail.com',
                'motivation' => 'Never stop exploring!',
                'phone' => '098-765-4321',
                'NIP' => '1234567890',
                'linkGdrive' => 'https://drive.google.com/janesmith',
            ],
        ];
        foreach ($teacher as $key => $value) {
            Teacher::create($value);
        }
    }
}
