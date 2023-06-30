<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')

    @foreach($posts as $post)
        <div>
            {{ $post->getTitle() }}
        </div>

        <div>
            {{ $post->getUserId()}}
        </div>

        <div>
            {{ $post->getShortDescription()}}
        </div>

        <div>

            <a href="{{ route('posts.show', $post->getKey()) }}">
                view this post
            </a>
        </div>

        <p> --- </p>
    @endforeach

    <div>
        {{ $posts->links() }}
    </div>
@endsection