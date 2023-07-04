@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container my-3 d-flex justify-content-end">
        <a href="{{ route('admin.comments.index') }}">
            All comments
        </a>
    </div>
    <div class="container my-3">
        <b>
            Edit comments
        </b>
    </div>
    <div class="container">
        <form action="{{ route('admin.comments.update', $comment->getKey()) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">
                    Publish
                </label>
                <select class="form-select" name="is_publish">
                    <option value="1">true</option>
                    <option value="0">false</option>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-mb btn-outline-secondary">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection