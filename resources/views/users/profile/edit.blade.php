@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <div class="container mt-3">

        <form action="{{ route('profile.update', $user->getKey()) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('users.profile._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-md btn-outline-secondary me-3">
                    Update user
                </button>
            </div>

        </form>
    </div>

@endsection