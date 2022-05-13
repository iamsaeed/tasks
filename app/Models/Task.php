<?php

namespace App\Models;

class Task extends App
{
    public function project()
    {
        return $this->belongsTo(Task::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
