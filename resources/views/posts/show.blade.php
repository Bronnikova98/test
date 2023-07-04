<?php
/**
 * @var \App\Models\Post $post
 */

/**
 * @var \App\Models\Comment $comment
 */
?>
@extends('layouts.base')

@section('title')
    {{ $post->getTitle() }}
@endsection

@section('content')
    <div class="container d-flex justify-content-end">
        <a href="{{ route('posts.index') }}">
            All posts
        </a>
    </div>
    <div class="container my-3 ">
        <h3 style="text-align: center; ">{{ $post->getTitle()}}</h3>
        <div class="d-flex justify-content-center">
            <img src="{{ $post->getFirstMediaUrl('preview', 'large') }}" style="max-width: 800px;">
        </div>
        <p class="mt-3">{{ $post->getText()}}</p>
        <b>By {{ $post->getUser()->getName()}}</b>
    </div>
    <div class="container py-3" style="border: 1px #666666 solid; border-radius: 10px;">
        <b>
            Form
        </b>
        @guest
            <p>Please, auth</p>
        @else
            <form action="{{ route('posts.comments.store', $post->getKey()) }}" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <label for="textarea-post" class="form-label">
                        Text comment
                    </label>
                    <textarea id="textarea-post" name="text"
                              class="form-control @error('text') is-invalid @enderror"></textarea>
                    @error('text')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-mb btn-outline-secondary mt-3">
                    Send
                </button>
            </form>
        @endguest
    </div>
    <div class="container my-3" style="border: #666666 1px solid; border-radius: 10px;">
        <div class="my-3">
            <b> Comments </b>
        </div>
        @foreach($comments as $comment)
            <div class="my-3" style="border-bottom: #a1a1aa 1px solid">
                <div class="d-flex">
                    <div>
                        <p style="background-color: #005cbf; color: #fff; border-radius: 4px; font-weight: bold;"
                           class="px-3 py-1">
                            {{ $comment->user->getName() }}
                        </p>
                    </div>
                    @if(auth()->id() === $post->getUserId())
                        <div class="ms-3 d-flex">
                            <div class="me-3">
                                <form action="{{ route('posts.comments.destroy', [$post->getKey(), $comment->getKey()]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <form action="{{ route('posts.comments.update', [$post->getKey(), $comment->getKey()]) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex">
                                    <div class="me-3">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                            Update
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <input type="number"
                                               class="form-control @error('is_publish') is-invalid @enderror"
                                               name="is_publish"
                                               value="{{ $comment->getIsPublish()}}" readonly>
                                        @error('is_publish')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div style="background-color: #fff; color: #000;" class="mt-3">
                    <p>
                        {{ $comment->getText() }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="container mt-3">
        {{ $comments->links() }}
    </div>
@endsection