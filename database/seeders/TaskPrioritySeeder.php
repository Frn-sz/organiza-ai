<?php

namespace Database\Seeders;

use App\Models\Task\TaskPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        TaskPriority::create(['priority' => 'Alta']);
        TaskPriority::create(['priority' => 'Média']);
        TaskPriority::create(['priority' => 'Baixa']);
    }
}
