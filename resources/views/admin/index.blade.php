<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container mt-3">
        <h5>
            {{ __('Панель администратора') }}
        </h5>
    </div>
    <div class="container">
        <p style="font-weight: bold; font-size: 20px; text-align: center;">
            {{ __('Посты') }}
        </p>

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
                                        <div class="d-flex">
                                            <button class="btn btn-sm btn-outline-secondary " type="button"
                                                    onclick="window.location='{{ URL::route('admin.posts.show', $post->getKey()) }}'">
                                                {{ __('Подробнее') }}
                                            </button>
                                            <div class="ms-3">
                                                <form action="{{ route('admin.posts.destroy', $post->getKey()) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                        {{ __('Удалить пост') }}
                                                    </button>
                                                </form>
                                            </div>

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