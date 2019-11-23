@extends('layouts.app')

@section('content')
    <h1 class="">{{$post->title}}</h1>
    <p class="text-muted">{{ $post->created_at->diffForHumans() }} - {{ $post->user->name }}</p>
    <p>{{ $post->content }}</p>

    {{-- tags --}}
    <ul class="p-0">
        @foreach ($post->tags as $tag)
        <li class="badge badge-dark d-inline">{{$tag->name}}</li>
        @endforeach
    </ul>
    <hr>
   @auth
        <h3>new comment</h3>
        <form action="/posts/{{$post->id}}/comments" method="post">  
            @csrf
            <div class="form-group">
                <label for="content">post content</label>
                <input type="content" class="form-control mb-3" id="content" name="content" value="{{ old('content') }}"  placeholder="Enter comment">
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn btn-success">submit</button>
            </div>
        </form>    
    @endauth

    <h2>Comments</h2>
    @if (!$post->comments->count())
        <p>No comments yet</p>        
    @else
    @foreach($post->comments as $comment)
        <div class="card card-body shadow mb-4">
            <p>{{ $comment->content }}</p>
            <div>
                <span class="text-muted">by {{ $post->user->name }}</span>
            -
            <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
    @endforeach
    @endif
@endsection