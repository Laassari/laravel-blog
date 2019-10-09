@extends('layout')

@section('title', 'Post')
    
@section('content')
<h1>this is post {{$post_id}}</h1>
<p>{{ $post_title }}</p>
@endsection