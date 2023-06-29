@extends('layouts.base')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    {{ $post->text }}
@endsection