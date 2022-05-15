<?php

namespace App\Models;

class Comment extends App
{
    protected $fillable = [
        'description', 'commentable_id', 'commentable_type', 'parent_id', 'created_id', 'updated_id'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
