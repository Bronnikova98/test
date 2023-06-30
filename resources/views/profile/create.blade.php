@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <div>
        <p>
            Create Post
        </p>
    </div>

    <div>
        {{--        <form action="{{ route('users.store') }}" method="POST">--}}
        {{--            @csrf--}}
        {{ Form::open(['method' => 'POST', 'url' => route('profile.posts.store')]) }}

        @include('profile._form')
        <div>
            <button type="submit">
                Add
            </button>
        </div>
        {{ Form::close() }}
        {{--        </form>--}}
    </div>

@endsection