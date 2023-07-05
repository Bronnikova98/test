@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container d-flex justify-content-end mt-3">
        <a href="{{ route('profile.posts.index') }}" style="text-decoration: none;">
            {{ __('Назад к моим постам') }}
        </a>
    </div>
    <div class="container my-3">
        <p class="mt-3" style="text-align: center; font-size: 20px; font-weight: bold;">
            {{ __('Создание поста') }}
        </p>
    </div>
    <div class="container">
        {{--        <form action="{{ route('users.store') }}" method="POST">--}}
        {{--            @csrf--}}
        {{ Form::open(['method' => 'POST', 'url' => route('profile.posts.store'), 'files' => true]) }}
        @include('profile._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-md btn-outline-secondary">
                {{ __('Добавить пост') }}
            </button>
        </div>
        {{ Form::close() }}
        {{--        </form>--}}
    </div>
@endsection