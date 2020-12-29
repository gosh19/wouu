@extends('layouts.base')

@section('title')
    Pedidos
@endsection

@php
    $colors = ['orange','red','pink','blue','purple','teal','indigo','green','gray'];
    $i = rand(0,(count($colors)-1));
@endphp

@section('body')
    <div class="container p-3">
        @auth
        <div class="mb-3">

            <p>{{Auth::user()->userData != null ? Auth::user()->userData->province.' - '.Auth::user()->userData->city:''}}</p>   
        </div>
        @endauth
        @if ($works != null)
            <p class="text-3xl font-bold text-{{$colors[$i]}}-400">Trabajos para vos</p>
            <hr class="border-2 border-{{$colors[$i]}}-800 my-2">
            @if (count($works) == 0)
                <div class="border-2 border-pink-600 p-3">
                    <p>
                        No hay trabajos en tu zona aun
                    </p>
                </div>
            @endif
            <div class="grid grid-flow-row grid-cols-1 md:grid-cols-4 gap-5">
                
                @foreach ($works as $key => $work)
                    <div class="col-span-1">
                        @include('works.box-work',['work'=>$work])
                    </div>    
                    @php
                        $i = rand(0,(count($colors)-1));
                    @endphp
                @endforeach
            </div>
            <div class="mb-5"></div>
        @endif
        <p class="text-3xl font-bold text-{{$colors[$i]}}-400">Ultimas publicaciones</p>
        <hr class="border-2 border-{{$colors[$i]}}-800 my-2">
        <div class="grid grid-flow-row grid-cols-1 md:grid-cols-4 gap-5">
            @foreach ($worksPendientes as $key => $work)
                <div class="col-span-1">
                    @include('works.box-work',['work'=>$work])
                </div>    
                @php
                    $i = rand(0,(count($colors)-1));
                @endphp
            @endforeach
        </div>
    </div>
@endsection