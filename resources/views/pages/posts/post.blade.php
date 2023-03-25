@extends('layouts.home')

@section('title')
    post @foreach ($post as $po)
         {{ $po->id }}
    @endforeach
@endsection 

@section('delete')
    {{ 'DELETE' }}
@endsection

@section('content')
    
    @foreach ($post as $po)
         {{ $po->title }}
         {{ $po->content }}
    @endforeach

@endsection