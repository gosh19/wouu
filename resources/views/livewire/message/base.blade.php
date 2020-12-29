<div class="container p-2" style="min-height: 100vh;">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="grid grid-cols-4 divide-x-2 gap-3 divide-black">
        <div class="col-span-1">
            @livewire('message.conversation-list',['user'=>$user])
        </div>
        <div class="col-span-3">
            @livewire('message.active-chat')
        </div>
    </div>
</div>
