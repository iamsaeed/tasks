<?php

namespace App\Models;

class Image extends App
{
    protected $fillable = ['id','name', 'imagable_type', 'imagable_id','status', 'created_id', 'updated_id'];

    public function imagable()
    {
        return $this->morphTo();
    }
}
