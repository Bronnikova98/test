<?php
/**
 * @var \App\Models\Comment $comment
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <div class="container mt-3">
        <b>
            Comments
        </b>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Post ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Comment
                </th>
                <th>
                    Publish
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>
                        {{ $comment->getKey() }}
                    </td>
                    <td>
                        {{ $comment->getPostId() }}
                    </td>
                    <td>
                        {{ $comment->user->getName()}}
                    </td>
                    <td>
                        {{ $comment->getText() }}
                    </td>
                    <td>
                        {{ $comment->getIsPublish() }}
                    </td>
                    <td>
                        <div class="row">
                            <div class="col d-flex">
                                <button class="btn btn-sm btn-outline-secondary me-3" type="button"
                                        onclick="window.location='{{ URL::route('admin.comments.edit', $comment->getKey()) }}'">
                                    Update
                                </button>

                                <form action="{{ route('admin.comments.destroy', $comment->getKey()) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container mt-3">
        {{ $comments->links() }}
    </div>
@endsection