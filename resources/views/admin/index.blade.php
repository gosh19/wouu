@extends('layouts.base')

@section('title')
    Panel Admin
@endsection

@section('body')
    <div>
        <div class="grid grid-cols-3 gap-4 p-3">
            <div class="col-span-1">
                <div class="bg-gradient-to-br from-pink-100 to-purple-200 p-3">
                    <p>Crear categoria</p>
                    <hr class="my-1">
                    <div>
                        <form action="{{route('Admin.createCategoria')}}" method="post">
                            @csrf
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name">
                            <input class="px-2 py-1 bg-purple-700 text-white" type="submit" value="Cargar">
                        </form>
                    </div>
                    <hr class="my-1">
                    <p>Categorias :</p>
                    <div class="grid grid-flow-row grid-cols-1">

                        @foreach ($categorias as $key => $categoria)
                            <div class="row-span-1 flex justify-between">
                                <p>{{$categoria->name}}</p>
                                <a href="{{route('Admin.deleteCategoria',['categoria'=> $categoria])}}"
                                    onclick="return confirm('Esta por borrar la categoria {{$categoria->name}}, ¿Esta seguro de eliminar la correcta?')"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="p-3 bg-gradient-to-br from-purple-200 to-blue-100">
                    <p>Tecnicos pendientes:</p>
                    <hr class="my-2">
                    @foreach ($tecnoPendientes as $i => $tecno)
                        <div class="flex justify-between">
                            <p>{{$tecno->user->name}}</p>
                            <p>{{$tecno->categoria->name}}</p>
                            <a onclick="return confirm('¿Seguro que desea Aprobar a {{$tecno->user->name}} ?')" 
                                class="p-1 bg-green-500 rounded text-white" 
                                href="{{route('Admin.editApproved',['tecno'=> $tecno, 'approved'=>1])}}"
                            >Aprobar</a>
                            <a onclick="return confirm('¿Seguro que desea Eliminar la peticion de {{$tecno->user->name}} ?')"  
                                href="{{route('Admin.editApproved',['tecno'=> $tecno, 'approved'=>0])}}"
                            ><i class="fas fa-trash-alt"></i></a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection