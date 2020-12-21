<div x-data="alan()" class="fixed bottom-10 right-5 z-50">
    <div class="relative">
        <div class="absolute right-20 bottom-0  w-48 p-2 ">
            @guest
            <div x-show.transition.duration.300ms="!showNumber" 
                class="relative border-2 border-red-300 p-3 rounded bg-gradient-to-tr from-red-300 via-purple-300 to-blue-400">
                <i wire:click="showNotification()" 
                    class="fas fa-times absolute top-1 right-2 cursor-pointer"></i>
                <p class="font-bold text-center text-gray-700 tracking-widest">{{$message}}</p>
                <hr class="border-2 border-purple-300 my-2">
                <div class="flex justify-between text-sm ">
                    <a class="text-purple-900" href="{{route('login')}}">Ingresar</a>
                    <a class="text-blue-900" href="{{route('register')}}">Registrarme</a>
                </div>
            </div>
            @endguest
            @auth
            <div wire:poll="setNotification()">
                <p wire:click="showNotification()" 
                    class="ml-auto block font-bold w-8 text-white cursor-pointer bg-red-600 px-3 py-1 rounded-full" 
                    :class="{'animate-bounce':showNumber}">

                    {{count($notificationsUnChecked)}}
                </p>
            </div>

            <div @click.away="showNotifications=false"  class="overflow-y-auto scrolling-auto mt-1 max-h-48 " 
                    x-show.transition.duration.300ms="showNotifications"        
            >
                @if (count($notificationsUnChecked) != 0)
                        
                    @foreach ($notificationsUnChecked as $noti)
                    
                        <div class="border-2 border-green-300 p-1 m-1 bg-green-200 rounded">
                            @include('alan.notification-work',['notification'=>$noti])
                            
                        </div>
                    @endforeach
                @endif
                @if (count($notificationsChecked) != 0)
                    @foreach ($notificationsChecked as $noti)
                        <div class="border-2 border-blue-300 p-1 m-1 bg-blue-200 rounded">
                           @include('alan.notification-work',['notification'=>$noti])
                            
                        </div>
                    @endforeach
                @endif
                
            </div>
            @endauth
        </div>
    </div>
    <div wire:click="showNotification()" class="cursor-pointer h-40 relative">

        <img x-show="showNumber" class="h-full"  src="{{ asset('images/alan.png') }}" alt="">
        <img x-show="!showNumber" class="h-full"  src="{{ asset('images/alan2.png') }}" alt="">

    </div>
</div>
<script>
    function alan() {
        return{
            showNumber:@entangle('showNumber'),
            showNotifications:@entangle('showNotifications'),
        }
    }
</script>

