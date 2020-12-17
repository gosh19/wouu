<div>
    <hr class="border-2 border-blue-600 my-5">
    <div class="shadow-2xl">
        <p class="text-xl font-bold text-yellow-600 p-3 border-2 border-yellow-300">¡Presupuesto elegido!</p>
        <div class="border-2 border-green-600 rounded p-3 bg-gradient-to-br from-green-600 to-green-300 ">
            <p class="text-lg font-bold text-white">{{$postulation->user->name}}</p>
            <hr class="my-2">
            <div class="flex justify-between">

                <p>{{$postulation->msg}}</p>
                <p class="text-lg font-bold">$ {{$postulation->presupuesto}} </p>
            </div>
        </div>
        <div x-data="score()" x-init="init()" class="border-2 border-yellow-300 p-3 flex justify-between">
            <div class="font-bold">
                @if ($comment == null)
                    <input type="text" class="w-1/2 border-2 border-yellow-300" wire:model="addComment">
                    <button wire:click="setComment" class="bg-yellow-300 font-bold py-1 px-2 rounded" >Cargar</button>
                @else
                    {{$comment}}
                @endif

            </div>
            <div class="flex">
                @if ()
                    
                @endif
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
        <script>
            function score() {
                return {
                    score:@entangle('score'),
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
                        if (this.score == null) {
                            
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
    </div>
</div>
