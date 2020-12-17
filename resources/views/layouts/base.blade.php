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
        @livewire('alan')
        <header>
            <nav class="shadow-2xl">
                <div class="flex justify-between h-14 py-2 px-4">
                    <a class="h-full" href="{{route('home')}}">
                        <img class="h-full" src="{{ asset('images/logo.png') }}" alt="Wouu">
                    </a>
                    <div class="flex">
                        <a href="{{route('Work.index')}}"
                            class="flex flex-1 self-center py-1 px-3 text-xs md:text-base rounded-2xl bg-gradient-to-r from-orange-500 via-red-500 to-pink-600 text-white"
                                >
                                    <p class="hidden md:block mr-2">TRABAJOS</p>
                                    <p>PEDIDOS</p>
                                    <i class="fas fa-screwdriver flex-1 self-center ml-1"></i>
                                

                        </a>
                        @auth
                            @if (Auth::user()->workDisponible()['cant'] != 0)
                            
                            <div x-data={open:true} class="flex-2 relative self-center" >
                                    <strong class=" text-white bg-purple-600 px-1 ml-1 rounded-lg">{{Auth::user()->workDisponible()['cant']}}</strong>
                                    @if (session('showWorks'))
                                        
                                    <div class="absolute top-15 right-0 w-56 bg-purple-500 z-50 rounded-xl text-white">
                                        
                                        <div x-show.transition.duration.400ms="open" class="text-center py-2 relative">
                                            <div @click="open=false" class="absolute right-3 top-0 cursor-pointer font-bold">x</div>
                                            <p class="px-7">
                                                ¡Tienes {{Auth::user()->workDisponible()['cant']}} trabajos disponibles para ver!
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="flex ">
                        @auth
                            @if (Auth::user()->admin)
                                <a class="px-2 py-1 flex-auto self-center mr-2 tracking-wider text-sm text-white rounded-2xl bg-gradient-to-r from-yellow-600 to-pink-600" 
                                    href="{{ route('Admin.index') }}"
                                >Admin <i class="fas fa-users-cog"></i></a>
                            @endif
                            <a class="px-2 py-1 flex flex-auto self-center mr-2 tracking-wider text-sm text-white rounded-2xl bg-gradient-to-r from-pink-600 to-purple-600" 
                            href="{{ route('User.index') }}"
                            >
                            <p class="hidden md:block mr-2">MI CUENTA</p>
                             <i class="fas fa-user-circle flex-1 self-center"></i></a>
                            <a class="flex-auto self-center text-sm py-1 px-2  text-white rounded-2xl bg-gradient-to-r from-purple-600 to-blue-600" 
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            ><i class="fas fa-door-open"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        @guest
                            
                        <a class="flex flex-1 self-center text-blue-700" href="{{ route('register') }}"><p class="hidden md:block mr-2">Registrarme</p> <i class="fas fa-user-plus"></i></a>
                        <div class="flex ml-5">
                            <a class="px-2 py-1 flex flex-1 self-center tracking-wider text-sm text-white rounded-2xl bg-gradient-to-r from-pink-600 to-purple-600" 
                            href="{{ route('login') }}"
                            ><p class="hidden md:block mr-2">INGRESAR</p> <i class="fas fa-user-circle flex-1 self-center"></i></a>
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
