@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <div class="container my-3">
        <b>
            Create Post
        </b>
    </div>

    <div class="container">
        {{--        <form action="{{ route('users.store') }}" method="POST">--}}
        {{--            @csrf--}}
        {{ Form::open(['method' => 'POST', 'url' => route('profile.posts.store'), 'files' => true]) }}

        @include('profile._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-sm btn-outline-secondary">
                Add
            </button>
        </div>
        {{ Form::close() }}
        {{--        </form>--}}
    </div>

@endsection