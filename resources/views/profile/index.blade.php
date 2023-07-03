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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                @foreach($userPosts as $userPost)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ $userPost->getFirstMediaUrl('preview', 'small') }}" alt=""
                                 style="max-width: 300px; margin: 0 auto;">

                            <div class="card-body">
                                <h4 class="mt-3"> {{ $userPost->getTitle() }}</h4>
                                <p>{{ $userPost->user->getName()}}</p>
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