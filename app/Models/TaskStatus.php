<?php

namespace App\Models;

class TaskStatus extends App
{
    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
