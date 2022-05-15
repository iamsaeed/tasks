<?php

namespace App\Traits;

use App\Models\Image;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;

trait Common
{
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toDayDateTimeString();
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->toDayDateTimeString();
    }

    public function created_by(){
        return $this->belongsTo(User::class, 'created_id', 'id');
    }

    public function updated_by(){
        return $this->belongsTo(User::class, 'updated_id', 'id');
    }

    public function deleted_by(){
        return $this->belongsTo(User::class, 'deleted_id', 'id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->withCount('comment_replies')
            ->where('parent_id', null)
            ->with('comment_replies');
    }

    public function comment_replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')
            ->where('parent_id', '!=', null)
            ->orderBy('created_at', 'desc');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable')->orderBy('created_at');
    }
}
