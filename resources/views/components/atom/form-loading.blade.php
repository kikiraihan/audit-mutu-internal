@props([
    'targetnya'=>'save',
    ])
<img class="saturate-50 opacity-80 d-block mr-auto ml-auto animate-pulse " src="{{asset('gambar/Loading_Outline.svg')}}" wire:loading wire:target="{{$targetnya}}" >