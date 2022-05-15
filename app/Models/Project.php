<?php

namespace App\Models;

class Project extends App
{
    protected $fillable = ['name', 'created_id', 'updated_id'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
