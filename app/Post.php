<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Likeable;

class Post extends Model
{
    use SoftDeletes, Likeable;

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
