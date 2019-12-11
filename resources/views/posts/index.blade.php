@extends('layouts.app')

@section('content')
<h1 class="">All Posts ({{ count($posts) }})</h1>
@if (count($posts) === 0)
    No Posts
@else
    <div class="row pt-3">
    @foreach ($posts as $post)
        <div class="col-8 mb-4 offset-2">
            <div class="card h-100 text-white bg-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                <h2 class="card-title d-inline">{{ $post->title }}</h2>
                            </a>
                           @canany(['update', 'delete'], $post)
                                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-transparent border-0 text-danger">
                                        @method('DELETE')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                           @endcanany
                    </div>
                    <p class="card-text">{{  Str::limit($post->content, 150, '...') }}</p>
                </div>
                <div class="card-footer text-muted d-flex justify-content-between flex-column">
                    <div class="d-flex justify-content-between">
                        <span>by {{ $post->user->name }}</span>
                        <span class="card-link">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <div>
                        @foreach ($post->tags as $tag)
                            <li class="badge badge-dark d-inline">
                                <a href="/posts/by-tag/{{$tag->name}}">{{$tag->name}}</a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center w-100">{{ $posts->links() }}</div>
    </div>

@endif

@endsection