<?php

namespace App\Models;

class TaskStatus extends App
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
