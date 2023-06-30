<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')
@section('title')
    {{ $post->getTitle()}}
@endsection

@section('content')
    <div class="container">
        <p>
            {{ $post->getText()}}
        </p>
    </div>
@endsection