<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content'];

    public function user() 
    {
        return $this->BelongsTo(\App\User::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class);
    }
}
