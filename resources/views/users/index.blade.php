<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div class="container my-3 d-flex justify-content-end">
        <button class="btn btn-sm btn-outline-secondary" type="button"
                onclick="window.location='{{ URL::route('users.create') }}'">
            Add User
        </button>
    </div>

    <div class="container">
        @if(empty($users))
            <p>
                Empty
            </p>
        @else
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Surname
                        </th>
                        <th>
                            Date of birth
                        </th>
                        <th>
                            Actions
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->getKey() }}
                            </td>
                            <td>
                                {{ $user->getName()}}
                            </td>
                            <td>
                                {{ $user->getSurname() }}
                            </td>
                            <td>
                                {{ $user->getDateOfBirth() }}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col d-flex">


                                        <button class="btn btn-sm btn-outline-secondary me-3" type="button"
                                                onclick="window.location='{{ URL::route('users.edit', $user->getKey()) }}'">
                                            Update
                                        </button>


                                        <form action="{{ route('users.destroy', $user->getKey()) }}" method="POST">
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
        @endif
    </div>
    <div class="container">
        {{ $users->links() }}
    </div>

@endsection