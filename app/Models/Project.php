<?php

namespace App\Models;

class Project extends App
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
