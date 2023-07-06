<?php
/**
 * @var \App\Models\Comment $comment
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container my-3 d-flex justify-content-end">
        <a href="{{ route('admin.comments.index') }}" style="text-decoration: none;">
            {{ __('Назад к комментариям') }}
        </a>
    </div>
    <div class="container my-3">
        <h5>
            {{ __('Панель администратора') }}
        </h5>
        <p style="text-align: center; font-size: 20px; font-weight: bold;">
            {{ __('Редактировать комментарий') }}
        </p>
    </div>
    <div class="container">
        <form action="{{ route('admin.comments.update', $comment->getKey()) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">
                    {{ __('Публикация') }}
                </label>
                <select class="form-select" name="is_publish">
                    <option value="1">true</option>
                    <option value="0">false</option>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-mb btn-outline-secondary">
                    {{ __('Обновить комментарий') }}
                </button>
            </div>
        </form>
    </div>
@endsection