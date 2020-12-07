<div x-data="btns()" class="mb-10">
    <p  class="text-3xl md:text-5xl text-center mb-4">¿Que necesitas?</p> 
    <div class="flex justify-center mx-3 text-white text-sm md:text-xl text-center mb-3">
        <button class="mr-10 bg-gradient-to-r from-pink-600 to-purple-600 py-2 px-6 rounded-xl shadow-2xl"
                @click="open(true,false)"
        >BUSCAR PROFESIONAL</button>
        <button class="bg-gradient-to-r from-purple-600 to-blue-600 py-2 px-6 rounded-xl shadow-2xl" 
                @click="open(false,true)" 
        >PUBLICAR UN PROBLEMA</button>
    </div>
    <div class="relative">
        <div @click.away="buscador=false" class="absolute left-0 right-0 z-20 " x-show.transition.in.duration.200ms.out.duration.200ms="buscador">
            <div class="md:w-1/2 mx-auto">
                <hr class="my-1">
                @livewire('buscador')
            </div>
        </div>
    </div>
    <div class="relative">
        <div @click.away="formProblema=false" class="absolute left-0 right-0 z-20 " x-show.transition.in.duration.200ms.out.duration.200ms="formProblema">
            <div class="md:w-2/5 mx-auto">
                <p class="text-xl text-center font-bold text-pink-600 bg-purple-100 border-2 border-gray-500 py-2"
                >¿Cual es el problema?</p>
                @livewire('form-work')
                <div class="text-xl text-center font-bold text-pink-600 bg-purple-100 border-2 border-gray-500 py-2">
                    <button class="bg-gradient-to-r from-red-600 to-pink-600 py-1 px-3 rounded text-white"
                            @click="formProblema=false"
                    >
                        Cerrar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function btns() {
        return {
            buscador: false,
            formProblema: false,
            open(v1,v2){
                this.buscador=v1;
                this.formProblema=v2;
            },
        }
    }
</script>