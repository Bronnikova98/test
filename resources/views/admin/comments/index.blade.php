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
        <h5>
            {{ __('Панель администратора') }}
        </h5>
        <p style="text-align: center; font-size: 20px; font-weight: bold;">
            {{ __('Комментарии') }}
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    {{ __('ID') }}
                </th>
                <th>
                    {{ __('ID поста') }}
                </th>
                <th>
                    {{ __('Имя') }}
                </th>
                <th>
                    {{ __('Фамилия') }}
                </th>
                <th>
                    {{ __('Комментарий') }}
                </th>
                <th>
                    {{ __('Публикация') }}
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
                        {{ $comment->user->getSurname()}}
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
                                    {{ __('Редактировать') }}
                                </button>

                                <form action="{{ route('admin.comments.destroy', $comment->getKey()) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        {{ __('Удалить') }}
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