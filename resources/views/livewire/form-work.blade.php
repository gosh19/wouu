<div class="bg-white shadow-2xl p-3 rounded border-2 border-gray-500">
    @if (!Auth::check())
        <div>
            <p class="text-lg text-pink-600 text-center font-bold tracking-wide mb-3">
                Debes registrarte para dejar un problema
            </p>
            <div class="flex justify-center">
                <a class="px-10 py-1 text-white rounded bg-gradient-to-r from-pink-600 via-purple-600 to-blue-600" 
                    href="{{route('register')}}"
                >REGISTRARME</a>
            </div>
        </div>
    @else
    
    <div x-data="form()" class="h-64 relative">

    
        <div x-show.transition.duration.500ms="formWork" class="grid grid-flow-row gap-3 p-4 absolute w-full">
            <div class="relative h-9">
                <div class="h-full w-full absolute z-10 left-1 top-1 bg-gradient-to-r from-pink-600 to-blue-600"></div>
                <input class="p-1 absolute z-20 border-2 border-purple-500 w-full bg-purple-100" 
                        type="text" wire:model="title" placeholder="Problema...">
            </div>
            <div class="relative h-15">
                <div class="h-full w-full absolute z-10 left-1 top-1 bg-gradient-to-r from-pink-600 to-blue-600"></div>

                <textarea placeholder="Descripcion del problema" wire:model="description"
                        class="p-1 absolute z-20 border-2 border-purple-500 w-full bg-purple-100"></textarea>
            </div>
            <div class="relative h-9 w-full">
                <div class="h-full w-full absolute z-10 left-1 top-1 bg-gradient-to-r from-pink-600 to-blue-600"></div>
                <select class="p-1 w-full absolute z-20 border-2 border-purple-500 bg-purple-200" 
                        wire:model="cat">
                    <option value="">Elija una categoria</option>
                    @foreach ($categorias as $key => $categoria)
                    <option value="{{$categoria}}">{{$categoria->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button class="px-10 py-1 text-white rounded bg-gradient-to-r from-pink-600 via-purple-600 to-blue-600" 
                        @click="siguiente()"
                    x-text="btnSiguiente"
                >
                </button>
            </div>
        </div>

        <div x-show.transition.duration.500ms="formImg" class="grid grid-flow-row gap-3 py-1 px-4 absolute w-full">
            <div class="grid grid-cols-3 gap-2">
                @for ($i = 0; $i < 3; $i++)
                    @php
                        $colors = ['pink','purple','blue']
                    @endphp
                    <div class="col-span-1">
                        <div class="relative h-10 mb-2">
                            <div class="h-10 w-full absolute bg-{{$colors[$i]}}-700 font-bold text-white text-center flex "
                            ><p class="flex-1 self-center">Subir foto <i class="fas fa-upload"></i></p></div>
                            <input wire:model="arch{{$i+1}}" name="arch[{{$i}}]" id="file-{{$i}}" type="file" class="bg-red absolute opacity-0 h-48 " />
                        </div>
                        <hr>
                        <div wire:ignore class="h-40 w-full overflow-hidden" id="preview-{{$i}}">
                            <div class="flex h-full text-center border-4 border-{{$colors[$i]}}-500">
                                <p class="flex-1 self-center font-bold text-{{$colors[$i]}}-700  text-lg">Imagen {{$i+1}} <i class="fas fa-file-upload"></i></p>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.getElementById("file-{{$i}}").onchange = function(e, index) {
                            prevImg(e, {{$i}});
                        }
                    </script>
                @endfor
                
            </div>
            <div class="flex justify-between">
                <button  class="px-10 py-1 text-white rounded bg-gradient-to-r from-orange-600 via-red-600 to-pink-600" 
                         @click="atras()"
                >Atras</button>
                <button  class="px-10 py-1 text-white rounded bg-gradient-to-r from-pink-600 via-purple-600 to-blue-600" 
                         wire:click="cargarWork()"
                >Cargar</button>
            </div>
        </div>

        <div x-show.transition.duration.500ms="loadingWork" class="flex justify-center w-full h-full">
            <div class="flex-1 self-center"><i class="fas fa-spinner fa-3x text-pink-500 animate-spin "></i></div>
        </div>
        <div x-show.transition.duration.500ms="loadingDone" class="flex justify-center w-full h-full">
            <div class="grid grid-flow-row">
                <div>

                    <p class="text-xl text-center font-bold text-green-500">Problema cargado con exito</p>
                </div>
                <div class="flex justify-center">
                    <i class="far fa-thumbs-up fa-5x text-green-500"></i><br>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        const form = () => {
            return{
                formWork:true,
                formImg:@entangle('formImg'),
                loadingWork: @entangle('loadingWork'),
                loadingDone: @entangle('loadingDone'),
                btnSiguiente: 'Siguiente',
                cat: @entangle('cat'),
                siguiente(){
                    if(this.cat == null){
                        this.btnSiguiente = "Debes elegir una categoria";
                        setTimeout(()=>{this.btnSiguiente = "Siguiente";},1500)
                        return 0;
                    }
                    this.formWork=false; 
                    this.formImg=true;
                },
                atras(){
                    this.formWork=true; 
                    this.formImg=false;
                }
            }
        }

        const prevImg = (e, index) => {
            let reader = new FileReader();

            reader.readAsDataURL(e.target.files[0]);

            reader.onload = function(){
                let preview = document.getElementById('preview-'+index),
                        image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    </script>
    @endif
</div>
