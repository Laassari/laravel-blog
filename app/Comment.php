<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Likeable;

class Comment extends Model
{
    use Likeable;
    public $fillable = ['content', 'user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(\App\Post::class);
    }
}
