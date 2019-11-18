<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $fillable = ['content', 'user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(\App\Post::class);
    }
}
