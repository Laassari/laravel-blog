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

<hr>
<h2>change password</h2>
<form action="{{ route('account.changePassword') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="old_password">old password</label>
        <input type="password" name="old_password" class="form-control" id="old_password">
    </div>
    @error('old_password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
        <label for="new_password">new password</label>
        <input type="password" name="new_password" class="form-control" id="new_password">
    </div>
    @error('new_password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
            <label for="password">confirm password</label>
            <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation">
        </div>
        @error('new_password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
    

    <input type="submit" value="change password" class="btn btn-success">
</form>
@endsection