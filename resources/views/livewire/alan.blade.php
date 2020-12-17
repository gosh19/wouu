<div x-data="alan()" class="fixed bottom-10 right-5 z-50">
    <div class="relative">
        <div class="absolute right-20 bottom-0  w-48 p-2 ">
            @guest
                <p>{{$message}}</p>
            @endguest
            @auth
            <div wire:poll="setNotification()">
                <p wire:click="showNotification()" class="ml-auto block font-bold w-8 text-white cursor-pointer bg-red-600 px-3 py-1 rounded-full" :class="{'animate-bounce':showNumber}">

                    {{count($notifications)}}
                </p>
            </div>

            <div class="overflow-y-auto scrolling-auto mt-1 max-h-48 " 
                    x-show.transition.duration.300ms="!showNumber"
            >
                @if (count($notifications) != 0)
                    
                    @foreach ($notifications as $noti)
                        <div class="border-2 border-green-300 p-1 m-1 bg-green-200 rounded">
                            @switch($noti->type)
                                @case('postulation')
                                    <span class="font-bold text-gray-500">{{$noti->getSender->name}}</span> dejo una propuesta en un 
                                    <a class="font-bold text-blue-800"
                                        href="{{route('Work.show',['work'=>$noti->work])}}">trabajo</a> 
                                    que publicaste
                                    @break
                                @case('selected')
                                    <span class="font-bold text-gray-500">{{$noti->getSender->name}}</span> 
                                    eligio tu propuesta en el
                                    <a class="font-bold text-blue-800"
                                        href="{{route('Work.show',['work'=>$noti->work])}}">trabajo</a> 
                                    donde te postulaste
                                    @break
                                @default
                                    
                            @endswitch
                            
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
        }
    }
</script>

