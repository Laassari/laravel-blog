@extends('layouts.app')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">post title</label>
        <input type="title" class="form-control" id="title" name="title" value="{{ old('title') }}"  placeholder="Enter title">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">post content</label>
        <input type="text" class="form-control" id="content" name="content" value="{{ old('content') }}"  placeholder="Enter content">
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <input type="submit" value="create post" class="btn btn-primary">
</form>
@endsection