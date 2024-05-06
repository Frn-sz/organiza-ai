<?php

namespace Database\Seeders;

use App\Models\Task\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task\TaskPriority;
use App\Models\Task\TaskStatus;
use App\Models\User;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Task::create([
                'title' => $faker->sentence,
                'description' => $faker->text,
                'date' => $faker->date,
                'time' => $faker->time,
                'status_id' => TaskStatus::inRandomOrder()->first()->id,
                'priority_id' => TaskPriority::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
