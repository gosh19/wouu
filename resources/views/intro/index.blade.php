@extends('layouts.base')

@section('body')
    <div class="flex justify-center py-6 mb-3">
        <img class="w-3/4" src="{{ asset('images/inicio.png') }}" alt="Inicio">
    </div>
    <div>
        @include('intro.btn-buscadores')
    </div>
    <hr class="border-1 border-red-700 mx-6 mb-10">
    <div class="max-w-screen-xl mx-auto px-4 mb-6">
        <!-- Grid wrapper -->
        <div class="-mx-4 flex flex-wrap">
          <!-- Grid column -->
          <div class="w-full flex flex-col p-4 sm:w-1/2 lg:w-1/3">
            <!-- Column contents -->
                <div class="w-100 text-center rounded-3xl overflow-hidden divide-y-8 divide-white">
                    <div class="bg-pink-500 h-24 relative flex justify-center">
                        <div class="absolute top-15 bg-pink-700 w-24 h-24 rounded-full border-8 border-white">
                            <p class=" font-bold text-white text-5xl">1</p>
                        </div>
                    </div>
                    <div class="bg-pink-200 px-6 py-20">
                        <p class="text-xl font-bold mb-1">Primero debes <a class="text-pink-900" href="{{route('register')}}">registrarte.</a></p>
                        <hr class="border-1 border-pink-700 mb-6">
                        <p class="mb-3">
                            Preisona en <a class="font-bold text-pink-800" href="{{route('register')}}">Registarte</a> y completa el 
                            formulario de registro con tus datos. Recuerda colocar un <strong>email</strong> que utilizes.
                    </div>
                </div>

          </div>
          <!-- Grid column -->
          <div class="w-full flex flex-col p-4 sm:w-1/2 lg:w-1/3">
            <!-- Column contents -->
                <div class="w-100  text-center rounded-3xl overflow-hidden divide-y-8 divide-white">
                    <div class="bg-purple-500 h-24 relative flex justify-center">
                        <div class="absolute top-15 bg-purple-700 w-24 h-24 rounded-full border-8 border-white">
                            <p class=" font-bold text-white text-5xl">2</p>
                        </div>
                    </div>
                    <div class="bg-purple-200 px-6 py-20">
                        <p class="text-xl font-bold mb-1">Encontrá una solución</p>
                        <hr class="border-1 border-purple-700 mb-6">
                        <p class="mb-3">Tanto si sos profesional como si
                            sos usuario, podrás encontrar o
                            publicar un problema mediante
                            nuestra plataforma.</p>
                    </div>
                </div>
                
          </div>
          <!-- Grid column -->
          <div class="w-full flex flex-col p-4 sm:w-1/2 lg:w-1/3">
            <!-- Column contents -->
                <div class="w-100 text-center rounded-3xl overflow-hidden divide-y-8 divide-white">
                    <div class="bg-blue-500 h-24 relative flex justify-center">
                        <div class="absolute top-15 bg-blue-700 w-24 h-24 rounded-full border-8 border-white">
                            <p class=" font-bold text-white text-5xl">3</p>
                        </div>
                    </div>
                    <div class="bg-blue-200 px-6 py-20">
                        <p class="text-xl font-bold mb-1">Pactá la visita</p>
                        <hr class="border-1 border-blue-700 mb-6">
                        <p class="mb-3">Utilizá nuestro chat para
                            coordinar la visita.</p>
                        <p>La misma será auditada por
                            nosotros en todo momento
                            para asegurar la calidad.</p>
                    </div>
                </div>
                
          </div>
        </div>
    </div>
    <div class="flex justify-center mb-15">
        <div class="bg-white shadow-2xl py-10 px-8 text-center">
            <p class="text-xl md:text-4xl">Si tenes alguna duda, comunicate al</p>
            <p class="text-xl md:text-5xl text-pink-700 font-bold">0810 345 0527</p>
        </div>
    </div>
@endsection