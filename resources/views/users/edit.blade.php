@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div>
        <p>
            Edit User
        </p>
    </div>

    <div>
        <form action="{{ route('users.update', $user->getKey()) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users._form')
            <div>
                <button type="submit">
                    Update
                </button>
            </div>

        </form>
    </div>
@endsection