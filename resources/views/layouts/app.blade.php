<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400..800&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">

    {{-- font awesome --}}
    {{-- snippets --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Livewireのスタイル -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    {{-- cssと繋いでる --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="{{ Auth::user()->theme ?? 'light' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bar_color">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="h5 mb-0 logo-design">{{ config('app.name') }}</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- [SOON] Search bar here --}}
                    {{-- @auth
                        @if (!request()->is('admin/*'))
                            <ul class="navbar-nav ms-auto">
                                <form action="{{ route('search') }}" style="width: 300px">
                                    <input type="search" name="search" class="form-control form-control-sm"
                                        placeholder="Search...">
                                </form>
                            </ul>
                        @endif
                    @endauth --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Home --}}
                            <li class="nav-item" title="Home">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="fa-solid fa-house icon-sm"></i>
                                </a>
                            </li>


                            {{-- Search --}}
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-magnifying-glass icon-sm"></i>
                                    </a>

                                    <div class="dropdown-menu p-1 shadow" aria-labelledby="searchDropdown" style="min-width: 250px;">
                                        <form action="{{ route('search') }}" class="d-flex">
                                            {{-- <input type="search" name="search" class="form-control me-2" placeholder="Search...">
                                            <button type="submit" class="btn btn-primary btn-sm">Go</button> --}}
                                            <input type="search" name="search" class="form-control form-control-sm" placeholder="Search...">
                                        </form>

                                        {{-- <hr class="dropdown-divider"> --}}
                                        {{-- ここに検索候補やLivewireのユーザーリストを表示できる --}}
                                        {{-- <div id="search-results"> --}}
                                            {{-- 例 --}}
                                            {{-- <a href="#" class="dropdown-item">User 1</a>
                                            <a href="#" class="dropdown-item">User 2</a> --}}
                                        {{-- </div> --}}
                                    </div>
                                </li>
                            </ul>


                            {{-- Create Post --}}
                            <li class="nav-item" title="Create Post">
                                <a href="{{ route('post.create') }}" class="nav-link">
                                    <i class="fa-solid fa-circle-plus icon-sm"></i>
                                </a>
                            </li>

                            {{-- Users --}}
                            <li class="nav-item" title="Users">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="fa-solid fa-users icon-sm"></i>
                                </a>
                            </li>

                            {{-- Account --}}
                            <li class="nav-item dropdown">
                                <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                            class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user icon-sm"></i>
                                    @endif
                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- [SOON] Admin controls --}}
                                    {{-- @if (Gate::allows('admin'))でもOK --}}
                                    @can('admin')
                                        <a href="{{ route('admin.users') }}" class="dropdown-item">
                                            <i class="fa-solid fa-user-gear"></i> Admin
                                        </a>

                                        <hr class="dropdown-divider">
                                    @endcan

                                    {{-- profiles --}}
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> profile
                                    </a>

                                    {{-- setting mode --}}
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#themeModal">
                                        <i class="fa-solid fa-clone"></i> setting mode
                                    </button>

                                    {{-- logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
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

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- [SOON] Admin controls --}}
                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users') }}"
                                    class="list-group-item {{ request()->is('admin/users') ? 'active' : '' }}">
                                    <i class="fa-solid fa-users"></i> Users
                                </a>
                                <a href="{{ route('admin.posts') }}"
                                    class="list-group-item {{ request()->is('admin/posts') ? 'active' : '' }}">
                                    <i class="fa-solid fa-newspaper"></i> Posts
                                </a>
                                <a href="{{ route('admin.categories') }}"
                                    class="list-group-item {{ request()->is('admin/categories') ? 'active' : '' }}">
                                    <i class="fa-solid fa-tags"></i> Categories
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Theme Modal -->
    <div class="modal fade" id="themeModal" tabindex="-1" aria-labelledby="themeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="themeModalLabel">Theme Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-2">
                        <button class="btn btn-outline-dark" onclick="setTheme('light')" data-bs-dismiss="modal">Light</button>
                        <button class="btn btn-outline-dark" onclick="setTheme('dark')" data-bs-dismiss="modal">Dark</button>
                        <button class="btn btn-outline-dark" onclick="setTheme('solarized')" data-bs-dismiss="modal">Solarized</button>
                        <button class="btn btn-outline-dark" onclick="setTheme('highcontrast')" data-bs-dismiss="modal">High Contrast</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mode setting JS -->
    <script>
    async function setTheme(theme) {
        document.body.classList.remove('light','dark','solarized','highcontrast');
        document.body.classList.add(theme);

        const res = await fetch('{{ route('user.theme') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ theme })
        });

        const data = await res.json();
        console.log('theme response:', data);
    }
    </script>


    <!-- Livewireのスクリプト -->
    @livewireScripts
</body>

</html>
