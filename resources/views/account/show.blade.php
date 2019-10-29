@extends('layouts.app')

@section('content')
<h1>update account info</h1>
<form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="name">name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
    </div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
        <label for="email">email</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
    </div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
        <label for="image">your avatar</label>
        <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
    </div>
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <input type="submit" value="update" class="btn btn-success">
</form>

@endsection