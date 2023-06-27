@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <div>
        <p>
            Create User
        </p>
    </div>

    <div>
{{--        <form action="{{ route('users.store') }}" method="POST">--}}
{{--            @csrf--}}
        {{ Form::open(['method' => 'POST', 'url' => route('users.store')]) }}

            @include('users._form')
            <div>
                <button type="submit">
                    Add
                </button>
            </div>
        {{ Form::close() }}

{{--        </form>--}}
    </div>

@endsection