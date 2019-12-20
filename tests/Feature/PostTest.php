<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test post creation
     *
     * @return void
     */

    public function it_create_a_post_with_valid_data()
    {
        $user = factory('App\User')->create();

        $response = $this->actingAs($user)->post(route('posts.index'), [
            'title' => 'post title',
            'content' => 'this is body content that should be stored',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('posts.index'))
            ->assertSessionHasNoErrors();


        $response = $this->followRedirects($response);

        // should redirect to posts index
        $response
            ->assertStatus(200)
            ->assertSeeText('post title')
            ->assertSeeText('this is body');

        $this->assertDatabaseHas('posts', [
            'title' => 'post title',
            'content' => 'this is body content that should be stored',
        ]);
    }

    /**
     * @test guest should be redirected to login
     *
     * @return void
     */

    public function a_guest_cant_create_a_post()
    {
        $response = $this->post(route('posts.index'), [
            'title' => 'post title',
            'content' => 'this is body content that should be stored',
        ]);

        $response
            ->assertRedirect('login');
    }

    /**
     * @test post creation get tags attached to it
     *
     * @return void
     */

    public function a_post_can_have_tags()
    {
        $this->seed("TagsTableSeeder");

        $user = factory('App\User')->create();
        $this->actingAs($user);

        $three_tags_ids = Tag::limit(3)->get('id')->pluck('id');

        $response = $this->actingAs($user)->post(route('posts.index'), [
            'title' => 'post title',
            'content' => 'this is body content that should be stored',
            'tags' => $three_tags_ids,
        ]);

        $response->assertStatus(302);

        $response = $this->followRedirects($response);

        $response->assertStatus(200);

        $post = Post::with('tags')->where('title', 'post title')->first();

        $this->assertEquals(3, $post->tags->count());
    }

    /** @test */
    public function a_user_can_like_and_unlike_a_post()
    {
        $user = factory('App\User')->create();
        $post = factory('App\Post')->create();

        $this->actingAs($user)->post("/posts/$post->id/toggle-like");
        
        $this->assertEquals(1, $post->likes->count());

        $this->actingAs($user)->post("/posts/$post->id/toggle-like");

        $this->assertEquals(0, $post->fresh()->likes->count());

    }
}
