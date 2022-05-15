<?php

namespace App\Models;

class Task extends App
{
    protected $fillable = [ 'id', 'title', 'description', 'project_id', 'ends_at', 'priority', 'task_status_id', 'created_id', 'updated_id' ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id', 'id');
    }
}
