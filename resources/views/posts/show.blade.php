@extends('layouts.app')

@section('content')
<h1 class="">{{$post->title}}</h1>
<p class="text-muted">{{ $post->created_at->diffForHumans() }} - {{ $post->user->name }}</p>
<p>{{ $post->content }}</p>
@endsection