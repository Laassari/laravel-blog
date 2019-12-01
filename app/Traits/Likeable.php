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

  public function isLikedBy(User $user)
  {
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
}