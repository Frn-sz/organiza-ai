<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPriority extends Model
{
    use HasFactory;

    protected $table = 'task_priority';

    public function tasks()
    {
        return $this->hasMany(Task::class, 'priority_id');
    }
}
