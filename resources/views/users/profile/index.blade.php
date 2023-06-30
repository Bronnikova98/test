<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container mt-3">
        <p>
            <b>
                User Profile
            </b>
        </p>
    </div>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="{{ $user->getPublicPath() }}" class="card-img-top" style="max-width: 100px;">
            <div class="card-body">
                <h5 class="card-title">{{ $user->getName() }} {{ $user->getSurname()}}</h5>
                <p class="card-text">{{ $user->getDateOfBirth() }}</p>
                <p class="card-text">{{ $user->getEmail() }}</p>
                <button class="btn btn-sm btn-outline-secondary me-3" type="button"
                        onclick="window.location='{{ URL::route('profile.edit', $user->getkey()) }}'">
                    Update User
                </button>
            </div>
        </div>
    </div>
@endsection