@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container my-3">
        <b>
            Edit User
        </b>
    </div>

    <div class="container">
        <form action="{{ route('users.update', $user->getKey()) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-md btn-outline-secondary">
                    Update
                </button>
            </div>

        </form>
    </div>
@endsection