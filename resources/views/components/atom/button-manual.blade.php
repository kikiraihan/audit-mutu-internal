@props([
    'color'=>'green'
    ])

<button 
    {!! $attributes->merge([
        'class'=>"shadow-sm p-2 rounded cursor-pointer text-white bg-".$color."-500 hover:bg-".$color."-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-".$color."-300"
    ]) !!} >
    {{$slot}}
</button>