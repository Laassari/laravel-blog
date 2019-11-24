<?php

namespace App\Http\Controllers;

use App\Mail\PostCreated;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->authorizeResource(Post::class, 'post', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:15',
            'tags' => 'exists:tags,id'
        ]);

        $post = $request->user()->posts()->create($validatedData);
        $post->tags()->attach($request->tags);

        \Mail::to($request->user()->email)->send(
            new PostCreated($post, $request->user())
        );

        session()->flash('post', 'post was created successfuly');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('posts.edit', ['post' => $post, 'tags' => $tags]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:15',
            'tags' => 'exists:tags,id'
        ]);


        $post->tags()->sync($request->tags);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        session()->flash('post', 'post was edited successfuly');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('post', 'post was deleted successfuly');
        return redirect(route('posts.index'));
    }

    public function getPostsByTag(Request $request, Tag $tag)
    {
        return view('posts.index', ['posts' => $tag->posts]);
    }
}
