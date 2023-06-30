<?php
/**
 * @var \App\Models\Post $userPost
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div>
        <a href="{{ route('profile.posts.create') }}">
            Add Post
        </a>
    </div>
    <p> --- </p>

    @foreach($userPosts as $userPost)

        <div>
            {{ $userPost->getTitle() }}
        </div>

        <div>
            {{ $userPost->getUserId() }}
        </div>

        <div>
            {{ $userPost->getShortDescription() }}
        </div>

        <div>
            <a href="{{ route('profile.posts.edit', $userPost->getKey()) }}">
                Update
            </a>
        </div>

        <div>
            <form action="{{ route('profile.posts.destroy', $userPost->getKey()) }}" method="POST">
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
        {{ $userPosts->links() }}
    </div>
@endsection