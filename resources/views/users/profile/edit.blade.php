@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <form action="{{ route('profile.update', $user->getKey()) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('users.profile._form')
        <div>
            <button type="submit">
                Update user
            </button>
        </div>

    </form>

@endsection