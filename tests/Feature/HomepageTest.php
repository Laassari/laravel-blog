<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function home_should_redirect_to_posts()
    {
        $response = $this->get('/');

        $response->assertStatus(302);

        $response->assertRedirect('/posts');
    }
}
