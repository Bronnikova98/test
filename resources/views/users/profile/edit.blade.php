<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container d-flex justify-content-end">
        <a href="{{ route('profile') }}" style="text-decoration: none;" class="mt-3">
            {{ __('Назад к профилю') }}
        </a>
    </div>
    <div class="container">
        <p style="font-weight: bold; font-size: 20px; text-align: center;">
            {{ __('Редактирование профиля') }}
        </p>
    </div>
    <div class="container mt-3">
        <form action="{{ route('profile.update', $user->getKey()) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('users.profile._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-md btn-outline-secondary me-3">
                    {{ __('Обновить профиль') }}
                </button>
            </div>
        </form>
    </div>
@endsection