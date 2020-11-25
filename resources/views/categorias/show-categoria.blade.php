@extends('layouts.base')

@section('body')
    <div>
        <hr class="border-4 border-blue-600">
        <div class="h-40 text-center flex bg-gradient-to-tr from-pink-500 via-purple-500 to-blue-500">
            <p class="text-4xl flex-1 self-center font-bold text-white tracking-widest">{{$selected->name}}</p>
        </div>
        <hr class="border-4 border-pink-600 mb-4">
        <div class="grid grid-cols-4 gap-4 px-2">
            <div class="col-span-1 border-r-2 border-l-2 border-blue-600 px-1">
                <div class="py-4">

                    @foreach ($categorias as $i => $categoria)
                        <div class="py-2">
                            @include('categorias.categoria-item',['categoria'=>$categoria])
                        </div>
                        @if (!$loop->last)
                            <hr class="border-2 border-purple-500">
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-span-3">

                <p class="text-2xl font-bold mb-2">Busca el tecnico que mas te guste</p>
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($selected->tecnos(1) as $key => $tecnico)
                        <div class="col-span-1 border-2 border-gray-400 shadow-xl p-2">
                            <div class="flex">
                                <div class="h-20 w-1/3 bg-blue-400 mr-3"
                                    style="background-image: url('{{asset('images/user.png')}}');
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            background-size: cover;
                                            position: relative;"
                                
                                ></div>
                                <div class="w-2/3">

                                    <p class="font-bold text-blue-700">{{$tecnico->user->name}}</p>
                                    <hr class="my-1">
                                    <p>Tel.: {{$tecnico->user->userData == null? '-':$tecnico->user->userData->phone}}</p>
                                    <small><i class="far fa-compass"></i> {{$tecnico->user->userData == null? '-':$tecnico->user->userData->city.' - '.$tecnico->user->userData->barrio}}</small>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="pl-2 ">
                                <p class="text-purple-700 mb-2">Reputacion</p>
                                <div class="grid grid-cols-5 gap-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="h-5 w-5 ">
                                            <img class="h-full" src="{{ asset('images/estrellas/Estrellagris.png') }}" alt="">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="w-full rounded bg-blue-500 hover:bg-blue-700 text-center transition-colors duration-300 py-2">
                                <a class="w-full text-white py-3 px-3" 
                                    href="{{route('Tecnico.show',['user'=>$tecnico->user])}}">Ver perfil</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection