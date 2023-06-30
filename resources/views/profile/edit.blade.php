@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container mt-3">
        <b>
            Edit Post
        </b>
    </div>

    <div class="container">

        <form action="{{ route('profile.posts.update', $post->getKey()) }}" method="POST">
            @csrf
            @method('PUT')

            @include('profile._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-mb btn-outline-secondary">
                    Update
                </button>
            </div>
        </form>


    </div>

@endsection