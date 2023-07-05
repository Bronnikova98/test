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
        <button class="btn btn-md btn-outline-secondary" type="button"
                onclick="window.location='{{ URL::route('profile.posts.create') }}'">
            {{ __('Создать пост') }}
        </button>
    </div>
    <div class="container">
        <p style="font-size: 20px; font-weight: bold; text-align: center;">
            {{ __('Мои посты') }}
        </p>
    </div>
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                @if(empty($userPosts))
                    <b>
                        {{ __('Посты не найдены') }}
                    </b>
                @else
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
                                                {{ __('Редактировать') }}
                                            </button>
                                            <div class="ms-3">
                                                <form action="{{ route('profile.posts.destroy', $userPost->getKey()) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                        {{ __('Удалить') }}
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
        {{ $userPosts->links() }}
    </div>
@endsection