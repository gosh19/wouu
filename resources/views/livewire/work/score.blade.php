<div  x-data="score()" x-init="init()" class="relative">
    <hr class="border-2 border-blue-600 my-5">
    <div class="shadow-2xl">
        <p class="text-xl font-bold text-yellow-600 p-3 border-2 border-yellow-300">¡Presupuesto elegido!</p>
        <div class="border-2 border-green-600 rounded p-3 bg-gradient-to-br from-green-500 to-green-50 ">
            <p class="text-lg font-bold text-white">{{$postulation->user->name}}</p>
            <hr class="my-2">
            <div class="flex justify-between">

                <p>{{$postulation->msg}}</p>
                <p class="text-lg font-bold">$ {{$postulation->presupuesto}} </p>
            </div>
        </div>
        <div class="p-3">
            <p class="text-xl text-gray-500"
                @click="canScore=true"
            >
                Puedes contactorlo a su numero registrado 
                <span class="font-bold text-green-500">
                    {{$postulation->user->userData != null ?$postulation->user->userData->phone:'sin registrar'}}
                </span>
            </p>
            <p @click="modalMsg=true" class="text-gray-500 text-lg cursor-pointer"

            >
                O enviale un mensaje 
                <i class="fas fa-envelope text-2xl animate-bounce text-red-600"></i>
            </p>
        </div>
        <div class="border-2 border-yellow-300 p-3 flex justify-between">
            <div class="font-bold">
                @if (($comment == null)&&($canScore))
                    <input type="text" class="w-1/2 border-2 border-yellow-300" placeholder="Deja un comentario..." wire:model="addComment">
                    <button wire:click="setComment" class="bg-yellow-300 font-bold py-1 px-2 rounded" >Cargar</button>
                @else
                    {{$comment}}
                @endif

            </div>
            <div class="flex">
                @for ($i = 0; $i < 5; $i++)
                    <div @mouseover="changeColor({{$i}});" wire:click="setScore({{$i+1}})" x-bind:class="color[{{$i}}]">
                        <i  class="fas fa-star text-xl mr-2"></i>
                    </div>                       
                @endfor

                @if ($this->score == null)
                    <p>Aun sin calificar</p>
                @endif
            </div>
        </div>
       
    </div>

    <div x-show="modalMsg" @click.away="modalMsg=false" class="absolute w-full bottom-0">
        <div class=" block w-full md:w-1/2 mx-auto p-4 border-2 bg-pink-50 border-pink-500 rounded">
            <p class="text-lg font-bold text-purple-500 mb-3">Envia un mensaje al tecnico</p>
            <textarea class="w-full h-20 border-2 border-blue-500 rounded p-2 bg-blue-50" 
                        wire:model.lazy="message"
                        placeholder="Deja tu mensaje..."></textarea>
            <hr class="my-2">
            <div class="flex justify-end">
                <button wire:click="sendMsg()" class="py-1 px-3 bg-red-600 text-white rounded font-bold">Enviar!</button>
            </div>
        </div>
    </div>
</div>
<script>
    function score() {
        return {
            score:@entangle('score'),
            canScore:@entangle('canScore'),
            modalMsg:false,
            yellow:'text-yellow-400',
            color:['','','','',''],
            init(){
                if (this.score != null) {
                    for (let index = 0; index < this.score; index++) {
                        this.color[index] = this.yellow;
                    }
                }
            },
            changeColor(i){
                let last = 0;
                if ((this.score == null)&&(this.canScore)) {
                    
                    for (let index = 0; index < i+1; index++) {
                        
                        this.color[index] = this.yellow;
                        last = index;
                    }
                    for (let index = last+1; index < 5; index++) {
                        
                        this.color[index] ='';
                    }
                }
            },
            setScore(i){
                this.score = i;
            }
        }
    }
</script>