<div>
    <div>
        <p class="border-2 border-blue-700 p-2 text-xl font-bold text-blue-500 bg-white">
            Chats con clientes
        </p>
        <div class="divide-y-2 divide-red-600">
            @foreach ($converAsTecnico as $key => $asTecno)
                <div class="p-3 flex justify-between">
                    <div wire:click="selectChat({{$asTecno}})" class="flex justify-between cursor-pointer">

                        <i class="fas fa-user-cog fa-2x flex-auto self-center w-10 text-blue-600"></i>
                        <p class="ml-2 text-lg">{{$asTecno->getCliente->name}}</p>
                    </div>
                    <div>

                        <small>
                            {{date_format($asTecno->updated_at,'d-m H:i')}}
                        </small>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
    <div>
        <p class="border-2 border-purple-700 p-2 text-xl font-bold text-purple-500 bg-white">
            Chats con tecnicos
        </p>
        <div>
            @foreach ($converAsCliente as $key => $asCliente)
            <div class="p-3 flex justify-between">
                <div class="flex justify-between">
                    <i class="fas fa-user fa-2x flex-auto self-center text-purple-600"></i>
                    <p class="ml-2 text-lg">{{$asCliente->getTecnico->name}}</p>
                </div>
                <div>

                    <small>
                        {{date_format($asCliente->updated_at,'d-m H:i')}}
                    </small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
