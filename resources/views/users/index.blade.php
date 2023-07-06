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
        <h5>
            {{ __('Панель администратора') }}
        </h5>
        <p style="text-align: center; font-size: 20px; font-weight: bold;">
            {{ __('Пользователи') }}
        </p>
    </div>
    <div class="container my-3 d-flex justify-content-end">
        <button class="btn btn-md btn-outline-secondary" type="button"
                onclick="window.location='{{ URL::route('users.create') }}'">
            {{ __('Создать пользователя') }}
        </button>
    </div>
    <div class="container">
        @if(empty($users))
            <p>
                {{ __('Пользователи не найдены') }}
            </p>
        @else
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ __('ID') }}
                        </th>
                        <th>
                            {{ __('Имя') }}
                        </th>
                        <th>
                            {{ __('Фамилия') }}
                        </th>
                        <th>
                            {{ __('Дата рождения') }}
                        </th>
                        <th>
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
                                            {{ __('Редактировать') }}
                                        </button>
                                        <form action="{{ route('users.destroy', $user->getKey()) }}" method="POST">
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
        @endif
    </div>
    <div class="container">
        {{ $users->links() }}
    </div>
@endsection