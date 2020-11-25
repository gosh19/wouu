<div class="grid mx-auto bg-white p-3 rounded shadow-2xl border-2 border-purple-500">
    <p class="text-2xl font-bold text-center text-purple-800">¿ Que estas buscando ?</p>
    <hr class="my-1">

    <input type="text" 
            wire:model="search" 
            class="border-2 border-purple-400 w-full p-2 justify-self-center rounded mb-2"
            placeholder="Ejemplo : reparacion de celulares"
    >

    <div class="p-2">
        @foreach ($result as $key => $data)
            @include('categorias.categoria-item',['categoria'=>$data])
            @if (!$loop->last)
                <hr class="my-1">
            @endif
        @endforeach
    </div>
</div>
