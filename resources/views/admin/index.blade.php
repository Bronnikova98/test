@extends('layouts.base')

@section('title')

@endsection

@section('content')

    @foreach($posts as $post)
        <div>
            {{ $post['title'] }}
        </div>

        <div>
            {{ $post['user_id'] }}
        </div>

        <div>
            {{ $post['short_description'] }}
        </div>

        <div>

            <a href="{{ route('admin.posts.show', $post->getKey()) }}">
                view this post
            </a>
        </div>

        <div>
            <form action="{{ route('admin.posts.destroy', $post['id']) }}" method="POST">
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
        {{ $posts->links() }}
    </div>
@endsection