@extends('layouts.base')

@section('title')
    {{$work->categoria->name}}
@endsection

@section('body')
<script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/balloon/ckeditor.js"></script>

<div class=" mx-10">
    <div class="my-2 text-blue-800">
        <p class="text-xl font-bold tracking-wider"><i class="fas fa-tag"></i> {{$work->categoria->name}}</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 py-3 gap-6 ">
        <div class="col-span-2">
            <div class="border-2 border-blue-600 p-3 mb-3">
                <div>
                    <p class="font-bold text-2xl text-blue-700">{{$work->title}}</p>
                </div>
                <hr>
                <div class="my-2">
                    <p>{{$work->description}}</p>
                </div>
            </div>
            @if (count($work->imgs) != 0)
                
            <div class="border-2 border-pink-600 p-3 ">
                <p class="text-xl font-bold text-pink-500">Imagenes descriptivas del problema</p>
                <hr class="border-2 border-pink-600 my-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-56">
                    @foreach ($work->imgs as $key => $img)
                        <div class="col-span-1 h-full overflow-hidden">
                            <img src="{{$img->url}}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="col-span-2 md:col-span-1">
            <div class="border-2 border-purple-600 rounded shadow-xl overflow-hidden">
                <div class="bg-purple-600 text-white py-2">
                    <p class="font-bold px-3">Datos del cliente</p>
                </div>
                <div class="p-2 bg-gradient-to-br from-white to-purple-200">
                    <p><strong class="text-gray-700">Nombre: </strong>{{$work->user->name}}</p>
                    <p><strong class="text-gray-700">Telefono: </strong>{{$work->user->userData->phone}}</p>
                    <p><strong class="text-gray-700">Telefono alt.: </strong>{{$work->user->userData->phone_alt}}</p>
                    <p><strong class="text-gray-700">Provincia: </strong>{{$work->user->userData->province}}</p>
                    <p><strong class="text-gray-700">Localidad: </strong>{{$work->user->userData->city}}</p>
                    <p><strong class="text-gray-700">Barrio: </strong>{{$work->user->userData->barrio}}</p>
                    <p class="text-red-500"><strong class="text-gray-700">Domicilio: </strong> Dato oculto</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-3 border-2 border-teal-700">
    <p class="font-bold text-2xl text-teal-500 mb-3">Postulaciones</p>
    <div class="grid grid-flow-row grid-cols-2 md:grid-cols-3 mb-5">
        <div class="row-span-1 col-span-2">
            @if (($work->user->id != Auth::id())&&($work->postSelected() == null))
                
            
            <div class="border-2 grid grid-flow-row border-indigo-800 p-2 bg-gradient-to-br from-white to-indigo-300">
                <p class="text-2xl text-purple-800 font-bold tracking-wider p-3">
                    <i class="fas fa-user-astronaut fa-2x"></i> 
                    {{Auth::check() ? Auth::user()->name:'Sin registrar'}} 
                    <span class="text-lg text-gray-500">{{$work->categoria->hasUser(Auth::id()) == null?'':' - Tecnico en '.$work->categoria->name}}</span>
                </p>

                @if ($work->categoria->hasUser(Auth::id()) == null )
                    <div class="p-3 border-2 border-pink-700 bg-pink-200">
                        <p class="text-red-700">
                            Debes <a class="font-bold" href="{{route('User.index')}}">postularte como tecnico</a> 
                            de la categoria <strong>{{$work->categoria->name}}</strong> para poder dejar un presupuesto.</p>
                    </div>
                @else
                    @php
                        $control = false;
                        if (Auth::user()->userData != null) {
                            if (Auth::user()->userData->phone != null){
                                $control = true;
                            }
                        }
                    @endphp
                    @if ($control)
                        <form class="w-full p-2" action="" method="post">
                            @csrf
                            <textarea id="editor" name="msg" 
                                    class="bg-white border-2 border-blue-600 h-28 mb-5 w-72 md:w-full"
                            ></textarea>
                            <div class="grid grid-flow-row md:flex justify-between">
                                <div class="text-xl text-green-500 font-bold mb-3">
                                    <label for="">Presupuesto: <i class="fas fa-dollar-sign text-green-700"></i> </label>
                                    <input type="number" name="presupuesto" step="0.1" class="border-2 border-green-500 w-44 px-3" placeholder="...." required>
                                </div>
                                <input type="submit" value="Cargar propuesta" class="py-1 px-4 bg-gradient-to-r rounded font-bold cursor-pointer text-white tracking-wider from-blue-400 via-purple-400 to-pink-500">
                            </div>
                        </form>
                    @else
                    <div class="p-3 border-2 border-pink-700 bg-pink-200">
                        <p class="text-red-700">
                            Completa tus datos con al menos un telefono de contacto en 
                            <a class="font-bold" href="{{route('User.index')}}">tu perfil de usuario</a> para poder postularte
                            a un trabajo
                            
                    </div>
                    @endif
                
                @endif
                
            </div>{{--end caja postulacion--}}
            @endif
        </div>
    </div>

    @if ($work->postSelected() != null)
        @livewire('work.score', ['postulation' => $work->postSelected()])
    @endif

    <hr class="border-2 border-pink-600 my-5">
    <div class="grid grid-flow-row md:grid-cols-2 gap-4">
        @php
            $colors = ['orange','red','pink','blue','purple','teal','indigo','gray'];
            $i = rand(0,(count($colors)-1));
        @endphp
        @if (count($work->postulations) != 0)
            @foreach ($work->postulations as $key => $postulation)
                <div class="p-3 border-2 border-{{$colors[$i]}}-700 md:col-span-1 bg-gradient-to-br from-white to-{{$colors[$i]}}-200">
                    <p class="text-xl text-{{$colors[$i]}}-600 font-bold">
                        <a href="{{route('Tecnico.show',['user'=>$postulation->user])}}">
                            <i class="fas fa-user-cog"></i> {{$postulation->user->name}}
                            <span class="text-lg text-gray-500">
                                {{$work->categoria->hasUser(Auth::id()) == null?'':' - Tecnico en '.$work->categoria->name}}
                            </span>
                        </a>
                    </p>
                    <hr class="my-2">
                    <p class="text-lg  text-{{$colors[$i]}}-700">{{$postulation->msg}}</p>
                    <hr class="my-2">
                    <div class="flex justify-between">
                        <div>
                            <p>{{$postulation->user->userData != null? $postulation->user->userData->province.' - '.$postulation->user->userData->city:null}}</p>
                            <p>{{$postulation->user->userData != null? $postulation->user->userData->phone.' - '.$postulation->user->userData->phone_alt:null}}</p>
                            <small>{{date_format($postulation->created_at,'d-m-Y  H:i')}}</small>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-{{$colors[$i]}}-700 tracking-widest"><i class="fas fa-dollar-sign"></i> {{$postulation->presupuesto}}</p>
                            @if ($work->user->id == Auth::id() && $work->postSelected() == null)
                                
                            <a class="w-full py-1 px-4 rounded border-2 border-{{$colors[$i]}}-700 text-center text-lg  text-white tracking-wider bg-gradient-to-r from-{{$colors[$i]}}-500 to-{{$colors[$i]}}-900"
                            onclick="return confirm('¿Seguro/a que desea elegir el presupuesto de {{$postulation->user->name}} por $ {{$postulation->presupuesto}}? ')"
                            href="{{route('Work.acceptTecno',['postulation'=>$postulation,'work'=>$work])}}"
                            >Elegir</a>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $i = rand(0,(count($colors)-1));
                @endphp
            @endforeach{{--foreach postulations--}}
        @else
        <div class="w-full md:col-span-2 p-3 border-2 border-red-500 bg-gradient-to-tr from-pink-200 to-transparent">
            <p class="text-xl font-bold">Aun no hay postulaciones</p>
        </div>
        @endif
        
    </div>


</div>
<script>
    BalloonEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection