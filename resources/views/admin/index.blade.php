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

            <a href="{{ route('admin.posts.show', $post->getKey()) }}">
                view this post
            </a>
        </div>

        <div>
            <form action="{{ route('admin.posts.destroy', $post->getKey()) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">
                    Delete
                </button>
            </form>
        </div>

        <p> --- </p>
    @endforeach

    <div>
        {{ $posts->links() }}
    </div>
@endsection