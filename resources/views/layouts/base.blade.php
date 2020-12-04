<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>{{ config('app.name') }} - @yield('title')</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>
        <script src="https://kit.fontawesome.com/0755f11027.js" crossorigin="anonymous"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body style="min-height: 100vh;">
        <header>
            <nav class="shadow-2xl">
                <div class="flex justify-between h-14 py-2 px-4">
                    <a class="h-full" href="{{route('home')}}">
                        <img class="h-full" src="{{ asset('images/logo.png') }}" alt="Wouu">
                    </a>
                    <div class="flex">
                        <a href="{{route('Work.index')}}"
                            class="flex-1 self-center py-1 px-3 rounded-2xl bg-gradient-to-r from-orange-500 via-red-500 to-pink-600 text-white"
                                >TRABAJOS PEDIDOS <i class="fas fa-screwdriver"></i></a>
                    </div>
                    <div class="flex ">
                        @auth
                            @if (Auth::user()->admin)
                                <a class="px-2 py-1 flex-auto self-center mr-2 tracking-wider text-sm text-white rounded-2xl bg-gradient-to-r from-yellow-600 to-pink-600" 
                                    href="{{ route('Admin.index') }}"
                                >Admin <i class="fas fa-users-cog"></i></a>
                            @endif
                            <a class="px-2 py-1 flex-auto self-center mr-2 tracking-wider text-sm text-white rounded-2xl bg-gradient-to-r from-pink-600 to-purple-600" 
                            href="{{ route('User.index') }}"
                            >MI CUENTA <i class="fas fa-user-circle"></i></a>
                            <a class="flex-auto self-center text-sm py-1 px-2  text-white rounded-2xl bg-gradient-to-r from-purple-600 to-blue-600" 
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            ><i class="fas fa-door-open"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        @guest
                            
                        <a class="flex-1 self-center text-blue-700" href="{{ route('register') }}">Registrarme <i class="fas fa-user-tag"></i></a>
                        <div class="flex ml-5">
                            <a class="px-2 py-1 flex-1 self-center tracking-wider text-sm text-white rounded-2xl bg-gradient-to-r from-pink-600 to-purple-600" 
                            href="{{ route('login') }}"
                            >INGRESAR <i class="fas fa-user-circle"></i></a>
                        </div>
                        @endguest
                    </div>
                </div>
            </nav>
        </header>

        @yield('body')
        
        <footer>
            <div class="py-5 shadow-2xl flex justify-around h-24">
                <img class="h-full" src="{{ asset('images/redes/ig.png') }}" alt="">
                <img class="h-full" src="{{ asset('images/redes/fb.png') }}" alt="">
                <img class="h-full" src="{{ asset('images/redes/wpp.png') }}" alt="">
            </div>
        </footer>
        @livewireScripts
    </body>
</html>
