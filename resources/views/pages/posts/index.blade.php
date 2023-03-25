@extends('layouts.home')

@section('title')
    posts
@endsection

@section('content')
    <ol>
        @foreach($posts as $post)
            <li><a href="/posts/{{$post->id}}">{{ $post->title }}</a></li>
        @endforeach

    </ol>
@endsection