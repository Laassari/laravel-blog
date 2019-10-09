<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($post_id)
    {
        return view('post', [
            'post_id' => $post_id,
            'post_title' => 'this is a post content about a random subject number one',
        ]);
    }

    public function index()
    {
        return '<h1>Posts index goes here...</h1>';
    }
}
