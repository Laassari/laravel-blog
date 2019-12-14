<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Likeable;
use App\User;
class Comment extends Model
{
    use Likeable;
    public $fillable = ['content', 'user_id', 'post_id', 'parent_id'];

    public function post()
    {
        return $this->belongsTo(\App\Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
