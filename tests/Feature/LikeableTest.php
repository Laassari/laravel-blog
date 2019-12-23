<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_like_a_post()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertEquals(0, $post->likes()->count());

        $post->toggleLike();

        $this->assertEquals(1, $post->likes()->count());
    }

    /** @test */
    public function it_can_like_a_comment()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $comment_user = factory(User::class)->create();

        $comment = $post->comments()->create([
            'content' => 'comment content',
            'user_id' => $comment_user->id
        ]);

        $this->actingAs($user)
            ->assertEquals(0, $comment->likes()->count());

        $comment->toggleLike();

        $this->assertEquals(1, $comment->likes()->count());

        $this->actingAs($comment_user);

        $comment->toggleLike();

        $this->assertEquals(2, $comment->likes()->count());
    }
}
