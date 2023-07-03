<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')

@section('title')
    {{ $post->getTitle() }}
@endsection

@section('content')
    <div class="container mt-3 ">
        <h3>{{ $post->getTitle()}}</h3>
        <img src="{{ $post->getFirstMediaUrl('preview', 'large') }}" style="max-width: 800px;">
        <p>{{ $post->getText()}}</p>

        <p>By {{ $post->getUser()->getName()}}</p>
    </div>
@endsection