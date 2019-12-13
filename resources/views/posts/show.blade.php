@extends('layouts.app')

@section('content')
    <h1 class="">{{$post->title}}</h1>
    <p class="text-muted">{{ $post->created_at->diffForHumans() }} - {{ $post->user->name }}</p>
    <p>{{ $post->content }}</p>

    {{-- like post--}}
    <form action="/posts/{{ $post->id}}/toggle-like" method="post" class="d-inline-block mr-3">
        @csrf
    <button class="btn {{ $post->isLikedByUser() ? 'btn-liked' : 'btn-unliked' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <span>{{ $post->likesCount }} Like(s)</span>
        </button>
    </form>
    {{-- tags --}}
    <ul class="p-0 d-inline-block">
        @foreach ($post->tags as $tag)
        <li class="badge badge-dark d-inline mr-1">
            <a href="/posts/by-tag/{{$tag->name}}">{{$tag->name}}</a>
        </li>
        @endforeach
    </ul>
    <hr>
   @auth
        <h3>new comment</h3>
        <form action="/posts/{{$post->id}}/comments" method="post">  
            @csrf
            <div class="form-group">
                <label for="content">post content</label>
                <textarea type="content" class="form-control mb-3" id="content" name="content" value="{{ old('content') }}"  placeholder="Enter comment"></textarea>
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
        @include('partials.commentsList', ['allComments' => $post->comments['root'], 'root' => true])
    @endif
@endsection

@section('head')
<style>
    .btn-liked svg{
        fill: red
    }
    .btn-liked:hover svg{
        fill: transparent
    }
    .btn-unliked svg{
        fill: transparent
    }
    .btn-unliked:hover svg{
        fill: red
    }
</style>
@endsection
