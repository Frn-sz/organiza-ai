<?php

namespace Database\Seeders;

use App\Models\Task\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        TaskStatus::create(['status' => 'Concluída']);
        TaskStatus::create(['status' => 'Pendente']);
        TaskStatus::create(['status' => 'Adiada']);
    }
}
