@extends('layouts.base')

@section('body')
    <div x-data="{editData: false, formTecno: false}" class="relative">

        <div x-show.transition.duration.300ms="editData" class="left-0 right-0 h-full absolute bg-black bg-opacity-50">
            <form action="{{route('User.editUserData',['user'=> $user])}}" method="post">
                @csrf
            
                <div @click.away="editData = false" class="bg-gradient-to-br from-pink-100 to-purple-300 mt-5 mx-1/4 p-3 border-2 rounded-lg border-black">
                    <div class="flex justify-between">
                        <p class="text-xl">Edita tus datos personales</p>
                        <button x-show.transition.duration.300ms="editData" @click="editData= false" ><i class="far fa-times-circle fa-2x text-red-600"></i></button>
                    </div>
                    <hr class="border-1 border-red-700 my-2">
                    <div class="grid grid-cols-2  text-gray-600 gap-4">

                        <div class="col-span-1">
                            <div class="grid grid-rows-3 gap-2">
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">DNI: </label>
                                    <input type="text" name="dni" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->dni : ''}}">
                                </div>
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">Direccion: </label>
                                    <input type="text" name="adress" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->adress : ''}}">
                                </div>
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">Barrio: </label>
                                    <input type="text" name="barrio" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->barrio : ''}}">
                                </div>
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">Telefono: </label>
                                    <input type="text" name="phone" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->phone : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="grid grid-rows-3 gap-2">
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">Ciudad: </label>
                                    <input type="text" name="city" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->city : ''}}">
                                </div>
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">Provincia: </label>
                                    <input type="text" name="province" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->province : ''}}">
                                </div>
                                <div class="row-span-1 flex justify-between">
                                    <label class="text-red-800">Telefono alt.: </label>
                                    <input type="text" name="phone_alt" class="border-2 border-red-800 rounded ml-2" value="{{$user->userData != null ? $user->userData->phone_alt : ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border-1 border-purple-800 my-2">
                    <div class="flex justify-center">
                        <input type="submit" value="Cargar" class="text-white bg-gradient-to-r from-purple-600 to-blue-600 py-2 px-6 rounded-xl shadow-2xl">
                    </div>
                </div>
            </form>
        </div>{{--End modal editar datos--}}

        <div x-show.transition.duration.300ms="formTecno" class="left-0 right-0 h-full absolute bg-black bg-opacity-50">           
            <div @click.away="formTecno = false" class="bg-gradient-to-br from-pink-100 to-purple-300 mt-5 mx-1/4 p-3 border-2 rounded-lg border-black">
                @foreach ($categorias as $j => $categoria)
                    <div class="flex justify-between my-2">
                        <p>{{$categoria->name}}</p>
                        @if ($categoria->hasUser($user->id) != null)
                            @if ($categoria->hasUser($user->id)->approved)
                                <a class="bg-green-300 p-2 text-black rounded" >Aprovado</a>
                            @else
                                <a class="bg-red-200 p-2 text-black rounded" >Pendiente</a>
                            @endif
                        @else
                            <a class="bg-blue-600 p-2 text-white rounded" href="{{route('User.postulacionTecnico',['user'=> $user,'categoria'=>$categoria])}}">Postularme</a>
                        @endif
                    </div>   
                @endforeach
            </div>
        </div>


        <div class="py-10 flex justify-center ">
            <div class="w-3/5 grid grid-cols-3 bg-white rounded-lg  shadow-2xl">
                <div class="col-span-1 h-full">
                    <div class="bg-gray-100 p-3 h-full">
                        <div class="flex justify-center py-6">

                            <img class="h-16" src="{{ asset('images/camera.png') }}" alt="">
                        </div>
                        <div>
                            <p>Usuario desde el {{date_format($user->created_at, 'd-m-Y')}} </p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 px-4">
                    <div class="py-4">
                        <p class="font-bold">{{$user->name}}</p>
                    </div>

                    
                    <div class="grid grid-cols-2  text-gray-600 mb-3">
                        <div class="col-span-1">
                            <div class="grid grid-rows-3 gap-2">
                                <div class="row-span-1">
                                    <p>DNI: {{$user->userData != null ? $user->userData->dni : ''}}</p>
                                </div>
                                <div class="row-span-1">
                                    <p>Direccion: {{$user->userData != null ? $user->userData->adress : ''}}</p>
                                </div>
                                <div class="row-span-1">
                                    <p>Ciudad: {{$user->userData != null ? $user->userData->city : ''}}</p>
                                </div>
                                <div class="row-span-1">
                                    <p>Provincia: {{$user->userData != null ? $user->userData->province : ''}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="grid grid-rows-3 gap-2">
                                <div class="row-span-1">
                                    <p>E-mail: {{$user->email}}</p>
                                </div>
                                <div class="row-span-1">
                                    <p>Barrio: {{$user->userData != null ? $user->userData->barrio : ''}}</p>
                                </div>
                                <div class="row-span-1">
                                    <p>Telefono: {{$user->userData != null ? $user->userData->phone : ''}}</p>
                                </div>
                                <div class="row-span-1">
                                    <p>Telefono alt.: {{$user->userData != null ? $user->userData->phone_alt : '-'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>

                        @if (count($user->tecnoDatas(1))!=0)
                        <div class="my-3 p-2 border-2 border-pink-700 bg-gradient-to-br from-pink-100 to-purple-200">
                            <p class="text-xl font-bold">Especialidades :</p>
                            <hr class="border-1 border-cool-gray-500 my-2">
                            @foreach ($user->tecnoDatas as $j => $tecno)
                                @if ($tecno->approved)
                                    
                                <div class="pb-2">
                                    <p class="tracking-wide">
                                        <i class="fas fa-angle-double-right"></i>
                                        {{$tecno->categoria->name}}
                                    </p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div> {{--End card user--}}

        <div class="flex justify-center pb-10">
            <button class="text-white bg-gradient-to-r from-purple-600 to-blue-600 py-2 px-6 rounded-xl shadow-2xl" 
                    @click="editData=true"
            >EDITAR DATOS</button>
            <button class="text-white ml-10 bg-gradient-to-r from-blue-600 to-green-600 py-2 px-6 rounded-xl shadow-2xl" 
                    @click="formTecno=true"
            >POSTULARME COMO TECNICO</button>
        </div>

        <hr class="border-1 border-purple-800 my-4 mx-5">

        <div class="pb-3">
            <p class="text-center text-4xl font-bold text-purple-800 mb-3">Historial de trabajos realizados</p>

            <div class="py-2 px-4 shadow-2xl border-2 border-pink-700 mx-1/5 bg-white">
                <p class="text-gray-500 ">Aun no hay trabajos para mostrar</p>
            </div>
        </div>

        <hr class="border-1 border-purple-800 my-4 mx-5">

        <div class="pb-3">
            <p class="text-center text-4xl font-bold text-blue-800 mb-3">Historial de trabajos pedidos</p>

            <div class="py-2 px-4 shadow-2xl border-2 border-purple-700 mx-1/5 bg-white">
                <p class="text-gray-500 ">Aun no hay trabajos para mostrar</p>
            </div>
        </div>
        
    </div>
@endsection