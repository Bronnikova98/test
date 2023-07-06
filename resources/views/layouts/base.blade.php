<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'По умолчанию')</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <b class="me-5" style="font-size: 18px;">{{ __('Учебный проект') }}</b>
                📝
                <a href="{{ route('posts.index') }}" style="text-decoration: none;" class="me-3">
                    {{ __('Посты') }}
                </a>
                @if (Route::has('login'))
                    @auth
                        🙂
                        <a href="{{ route('profile') }}" class="me-3"
                           style="text-decoration: none;">{{ __('Профиль') }}</a>
                    @endauth
                @endif
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        📃
                        <a href="{{ route('admin.posts.index') }}" style="text-decoration: none; color: #491217;"
                           class="me-3">
                            {{ __('Посты') }}
                        </a>
                        🖍
                        <a href="{{ route('admin.comments.index') }}" style="text-decoration: none; color: #491217;"
                           class="me-3">
                            {{ __('Комментарии') }}
                        </a>
                        🐱
                        <a href="{{ route('users.index') }}" style="text-decoration: none; color: #491217;">
                            {{ __('Пользователи') }}
                        </a>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти из профиля') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@yield('content')
</body>
</html>