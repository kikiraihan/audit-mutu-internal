@props([
    'w' => 20
])

<div class="w-{{$w}}">
    <img 
    {!! $attributes->merge([
        'class'=>"cursor-pointer shadow hover:shadow-lg",
        'alt'=>"kosong",
    ]) !!} >
</div>