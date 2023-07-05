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
        <b>
            {{ __('Редактирование поста') }}
        </b>
    </div>
    <div class="container">
        <form action="{{ route('profile.posts.update', $post->getKey()) }}" method="POST">
            @csrf
            @method('PUT')
            @include('profile._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-mb btn-outline-secondary">
                    {{ __('Обновить пост') }}
                </button>
            </div>
        </form>
    </div>
@endsection