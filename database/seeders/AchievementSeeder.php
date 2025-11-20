<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataAchivement = [
            [
                'title' => 'Math Olympiad Winner',
                'description' => 'Won first place in the national math olympiad.',
                'level' => 'National',
                'image' => 'images/achievement/math-olympiad.jpg',
                'date' => '2022-05-15'
            ],
            [
                'title' => 'Science Fair Champion',
                'description' => 'Secured the championship in the regional science fair.',
                'level' => 'Regional',
                'image' => 'images/achievement/Science-fair.jpg',
                'date' => '2021-11-20'
            ],
            [
                'title' => 'Art Competition Finalist',
                'description' => 'Reached the finals in the state art competition.',
                'level' => 'State',
                'image' => 'images/achievement/art_competition.jpg',
                'date' => '2023-03-10'
            ],
            [
                'title' => 'Coding Hackathon Winner',
                'description' => 'Won the first prize in the national coding hackathon.',
                'level' => 'National',
                'image' => 'images/achievement/hackathon.png',
                'date' => '2022-08-25'
            ],
            [
                'title' => 'Debate Championship',
                'description' => 'Champion of the inter-college debate competition.',
                'level' => 'Inter-College',
                'image' => 'images/achievement/debate_championship.jpg',
                'date' => '2021-12-05'
            ],
        ];

        foreach ($dataAchivement as $achievement) {
            Achievement::create($achievement);
        }
    }
}
