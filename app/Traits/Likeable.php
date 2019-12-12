<?php

namespace App\Traits;

use \App\User;
use \App\Like;

trait likeable 
{

  public function likes()
  {
    return $this->morphMany(Like::class, 'likeable');
  }

  public function isLikedByUser(User $user = null)
  {
    $user = $user ?: auth()->user();
    if (!$user) return false;
    return $this->likes()
      ->where('user_id', $user->id)
      ->exists();
  }


  public function toggleLike()
  {
    $like = $this->likes()->where('user_id', auth()->id());

    if ($like->exists())
    {
      $like->delete();
    } else  {
      $this->likes()->save(
          new Like(['user_id' => auth()->id()])
      );
    }
  }

  public function getLikesCountAttribute()
  {
    return $this->likes->count();
  }
}