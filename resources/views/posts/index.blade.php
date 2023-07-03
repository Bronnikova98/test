<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                @foreach($posts as $post)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ $post->getFirstMediaUrl('preview', 'small') }}" alt=""
                                 style="max-width: 300px; margin: 0 auto;">
                            <div class="card-body">
                                <h4 class="mt-3"> {{ $post->getTitle() }}</h4>
                                <p>{{ $post->user->getName()}}</p>
                                <p class="card-text">{{ $post->getShortDescription()}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary" type="button"
                                                onclick="window.location='{{ URL::route('posts.show', $post->getKey()) }}'">
                                            View
                                        </button>
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
        {{ $posts->links() }}
    </div>
@endsection