@extends('layouts.base')

@section('title')

@endsection

@section('content')
    <div>
        <a href="{{ route('users.create') }}">
            Add User
        </a>
    </div>

    <div class="container">
        @if(empty($users))
            <p>
                Empty
            </p>
        @else
            <div>
                <table>
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
                                {{ $user['id'] }}
                            </td>
                            <td>
                                {{ $user['name'] }}
                            </td>
                            <td>
                                {{ $user['surname'] }}
                            </td>
                            <td>
                                {{ $user['date_of_birth'] }}
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user['id']) }}">
                                    Update
                                </a>
                                <div>
                                    <form action="{{ route('users.destroy', $user['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection