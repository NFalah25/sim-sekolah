<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtracurricularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extracurriculars = [
            [
                'name' => 'Basketball Club',
                'description' => 'Join our Basketball Club to improve your skills and teamwork on the court.',
                'image' => 'images/extracurriculars/basketball.jpg',
            ],
            [
                'name' => 'Art Club',
                'description' => 'Express your creativity and learn new art techniques in our Art Club.',
                'image' => 'images/extracurriculars/art.jpg',
            ],
            [
                'name' => 'Science Club',
                'description' => 'Explore the wonders of science through experiments and projects in our Science Club.',
                'image' => 'images/extracurriculars/science.jpg',
            ],
        ];

        foreach ($extracurriculars as $extracurricular) {
            Extracurricular::create($extracurricular);
        }
    }
}
