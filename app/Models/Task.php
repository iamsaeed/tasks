<?php

namespace App\Models;

class Task extends App
{
    protected $fillable = [ 'id', 'title', 'description', 'project_id' ];

    public function project()
    {
        return $this->belongsTo(Task::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
