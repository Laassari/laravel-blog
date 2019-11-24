@extends('layouts.app')

@section('content')
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">post title</label>
        <input type="title" class="form-control" id="title" name="title" value="{{ $post->title }}"  placeholder="Enter title">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">post content</label>
        <input type="text" class="form-control" id="content" name="content" value="{{ $post->content }}"  placeholder="Enter content">
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
            <span>tags</span>
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input"  @if ($post->tags->contains('id', $tag->id)) checked @endif type="checkbox" value="{{ $tag->id }}" name="tags[]" id="defaultCheck-{{ $tag->id }}">
                    <label class="form-check-label" for="defaultCheck-{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    <input type="submit" value="create post" class="btn btn-primary">
</form>
@endsection