<div class="text-sm">
@switch($notification->type)
@case('postulation')
    <span class="font-bold text-gray-500">{{$notification->getSender->name}}</span> dejo una propuesta en un 
    <a class="font-bold text-blue-800"
        href="{{route('Work.show',['work'=>$notification->work])}}">trabajo</a> 
    que publicaste
    @break
@case('selected')
    <span class="font-bold text-gray-500">{{$notification->getSender->name}}</span> 
    eligio tu propuesta en el
    <a class="font-bold text-blue-800"
        href="{{route('Work.show',['work'=>$notification->work])}}">trabajo</a> 
    donde te postulaste
    @break
@default
@endswitch
</div>
<hr class="my-1">
<div>
    <small>{{date_format($notification->created_at,'d-m-Y H:i')}}</small>
</div>