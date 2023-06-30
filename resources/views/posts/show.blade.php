<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.base')

@section('title')
    {{ $post->getTitle() }}
@endsection

@section('content')
    {{ $post->getText() }}
@endsection