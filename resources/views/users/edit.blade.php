<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container mt-3 d-flex justify-content-end">
        <a href="{{ route('users.index') }}" style="text-decoration: none;">
            {{ __('Назад к пользователям') }}
        </a>
    </div>
    <div class="container my-3">
        <h5>
            {{ __('Панель администратора') }}
        </h5>
        <p style="text-align: center; font-size: 20px; font-weight: bold;">
            {{ __('Редактирование пользователя') }}
        </p>
    </div>
    <div class="container">
        <form action="{{ route('users.update', $user->getKey()) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-md btn-outline-secondary">
                    {{ __('Обновить пользователя') }}
                </button>
            </div>
        </form>
    </div>
@endsection