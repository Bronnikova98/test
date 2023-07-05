<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')
@section('title')
    {{ $post->getTitle()}}
@endsection

@section('content')
    <div class="container d-flex justify-content-end mt-3">
        <a href="{{ route('admin.posts.index') }}" style="text-decoration: none;">
            {{ __('Назад к постам') }}
        </a>
    </div>
    <div class="container my-3 ">
        <h3 style="text-align: center; ">{{ $post->getTitle()}}</h3>
        <div class="d-flex justify-content-center">
            <img src="{{ $post->getFirstMediaUrl('preview', 'large') }}" style="max-width: 800px;">
        </div>
        <p class="mt-3">{{ $post->getText()}}</p>
        <b>By {{ $post->getUser()->getName()}}</b>
    </div>
@endsection