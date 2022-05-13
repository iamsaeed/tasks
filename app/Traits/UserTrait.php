<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Project;
use App\Models\Task;

trait UserTrait
{
    public function comments_created()
    {
        return $this->hasMany(Comment::class, 'created_id', 'id')
            ->where('status','active');
    }

    public function projects_created()
    {
        return $this->hasMany(Project::class, 'created_id', 'id')
            ->where('status','active');
    }

    public function tasks_created()
    {
        return $this->hasMany(Task::class, 'created_id', 'id')
            ->where('status','active');
    }

    public function images_created()
    {
        return $this->hasMany(Image::class, 'created_id', 'id')
            ->where('status','active');
    }

    public function comments_updated()
    {
        return $this->hasMany(Comment::class, 'updated_id', 'id');
    }

    public function projects_updated()
    {
        return $this->hasMany(Project::class, 'updated_id', 'id');
    }

    public function tasks_updated()
    {
        return $this->hasMany(Task::class, 'updated_id', 'id');
    }

    public function images_updated()
    {
        return $this->hasMany(Image::class, 'updated_id', 'id');
    }
}
