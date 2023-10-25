<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task\TaskPriority;
use App\Models\Task\TaskStatus;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    public function priorityId()
    {
        return $this->hasOne(TaskPriority::class, 'id', 'priority_id');
    }

    public function statusId()
    {
        return $this->hasOne(TaskStatus::class, 'id', 'status_id');
    }

    public function userId()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'priority_id',
        'status_id',
        'user_id',
    ];
}
