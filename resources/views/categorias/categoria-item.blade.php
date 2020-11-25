<div class="flex justify-between">
    <p>{{$categoria->name}}</p>
    <a class="py-1 px-3 rounded bg-blue-600 hover:bg-blue-400 text-white font-bold" 
        href="{{route('Categoria.show',['categoria'=> $categoria])}}"
    >Ver</a>
</div>