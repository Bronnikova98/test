<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    @auth
        <div class="container my-3 d-flex justify-content-end">
            <button class="btn btn-md btn-outline-secondary" type="button"
                    onclick="window.location='{{ URL::route('profile.posts.create') }}'">
                {{ __('Создать пост') }}
            </button>
        </div>
    @endauth
    <div class="mt-3">
        <p style="text-align: center; font-size: 20px; font-weight: bold;">{{ __('Посты') }}</p>
    </div>
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                @if(empty($posts))
                    <b>
                        {{ __('Посты не найдены') }}
                    </b>
                @else
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
                                                {{ __('Подробнее') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="container mt-3">
        {{ $posts->links() }}
    </div>
@endsection