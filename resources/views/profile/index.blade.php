@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div>
        <a href="{{ route('profile.posts.create') }}">
            Add Post
        </a>
    </div>
    <p> --- </p>

    @foreach($userPosts as $userPost)

        <div>
            {{ $userPost['title'] }}
        </div>

        <div>
            {{ $userPost['user_id'] }}
        </div>

        <div>
            {{ $userPost['short_description'] }}
        </div>

        <div>
            <a href="{{ route('profile.posts.edit', $userPost['id']) }}">
                Update
            </a>
        </div>

        <div>
            <form action="{{ route('profile.posts.destroy', $userPost['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" >
                    Delete
                </button>
            </form>
        </div>

        <p> --- </p>

    @endforeach

    <div>
        {{ $userPosts->links() }}
    </div>
@endsection