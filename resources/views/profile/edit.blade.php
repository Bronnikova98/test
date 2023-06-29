@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div>
        <p>
            Edit Post
        </p>
    </div>

    <div>

        <form action="{{ route('profile.posts.update', $post->getKey()) }}" method="POST">
            @csrf
            @method('PUT')

        @include('profile._form')
        <div>
            <button type="submit">
                Update
            </button>
        </div>
        </form>


    </div>

@endsection