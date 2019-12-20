<?php

namespace Tests\Feature;

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
}
