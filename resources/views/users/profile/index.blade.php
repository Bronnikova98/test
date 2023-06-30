<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')

    <div>
        <p>
            <b>
                User Profile
            </b>
        </p>
    </div>


    <div>
        <p>
            {{ $user->getName() }}
        </p>
    </div>

    <div>
        <p>
            {{ $user->getSurname()}}
        </p>
    </div>

    <div>
        <p>
            {{ $user->getDateOfBirth() }}
        </p>
    </div>

    <div>
        <p>
            {{ $user->getEmail()}}
        </p>
    </div>

    <div>
        <img src="{{ $user->getPublicPath() }}">
    </div>


    <div>
        <a href="{{ route('profile.edit', $user->getkey()) }}">
                Update User
            </a>
        </div>



@endsection