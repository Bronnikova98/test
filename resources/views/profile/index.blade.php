<?php
/**
 * @var \App\Models\Post $userPost
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container my-3 d-flex justify-content-end">
        <button class="btn btn-sm btn-outline-secondary" type="button"
                onclick="window.location='{{ URL::route('profile.posts.create') }}'">
            Add Post
        </button>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                @foreach($userPosts as $userPost)

                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                 preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title> {{ $userPost->getTitle() }}</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $userPost->getUserId()}}</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">{{ $userPost->getShortDescription()}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-outline-secondary" type="button"
                                                onclick="window.location='{{ URL::route('profile.posts.edit', $userPost->getKey()) }}'">
                                            Update
                                        </button>

                                        <div class="ms-3">
                                            <form action="{{ route('profile.posts.destroy', $userPost->getKey()) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <div class="container mt-3">
        {{ $userPosts->links() }}
    </div>
@endsection