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
        <div class="grid grid-flow-row grid-cols-1 md:grid-cols-4 gap-3 bg-">
            @foreach ($works as $key => $work)
                <div class="col-span-1">
                    <div class="border-2 border-{{$colors[$i]}}-800 rounded bg-gradient-to-br from-white to-{{$colors[$i]}}-100 shadow-xl">
                        <div class="p-1 bg-{{$colors[$i]}}-800">
                            <p class="text-md text-white"><i class="fas fa-tag"></i> {{$work->categoria->name}}</p>
                        </div>
                        <hr class="w-full border-black border-1">
                        <div class="p-2">
                            <div>
                                <p class="text-{{$colors[$i]}}-600"><i class="fas fa-user"></i> {{$work->user->name}}</p>
                                <p class="text-sm text-gray-500">{{$work->user->userData != null ? $work->user->userData->province.' - '.$work->user->userData->city:''}}</p>
                            </div>
                            <hr class="my-1 border-1 border-{{$colors[$i]}}-700">
                            <div class="my-2">
                                <p class="text-lg font-bold">{{$work->title}}</p>
                                <p class="text-md">{{$work->description}}</p>
                            </div>
                        
                        <hr class="my-1 border-1 border-{{$colors[$i]}}-700">
                        <div class="w-full">
                            <a href="{{route('Work.show',['work'=>$work])}}"
                                class="block text-center bg-{{$colors[$i]}}-700 font-bold tracking-widest text-white py-1 rounded"
                                >VER MAS</a>
                        </div>
                        </div>
                    </div>
                </div>    
                @php
                    $i = rand(0,(count($colors)-1));
                @endphp
            @endforeach
        </div>
    </div>
@endsection