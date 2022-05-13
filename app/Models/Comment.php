<?php

namespace App\Models;

class Comment extends App
{
    public function commentable()
    {
        return $this->morphTo();
    }
}
