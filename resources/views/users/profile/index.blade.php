<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container my-3">
        <div class="row">
            <div class="col">
                <b>
                    {{ __('Мой профиль') }}
                </b>
            </div>
            <div class="col">
                <a href="{{ route('profile.posts.index') }}" style="text-decoration: none;">
                    {{ __('Мои посты') }}
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="{{ $user->getPublicPath() }}" class="card-img-top" style="max-width: 100px;">
            <div class="card-body">
                <h5 class="card-title">{{ $user->getName() }} {{ $user->getSurname()}}</h5>
                <p class="card-text">{{ $user->getDateOfBirth() }}</p>
                <p class="card-text">{{ $user->getEmail() }}</p>
                <button class="btn btn-sm btn-outline-secondary me-3" type="button"
                        onclick="window.location='{{ URL::route('profile.edit', $user->getkey()) }}'">
                    {{ __('Редактировать профиль') }}
                </button>
            </div>
        </div>
    </div>
@endsection