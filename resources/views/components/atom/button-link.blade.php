@props([
    'color'=>'green'
    ])

<a 
    {!! $attributes->merge([
        'class'=>"transform f-roboto
        shadow-sm p-2 rounded cursor-pointer text-white bg-".$color."-500 hover:bg-".$color."-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-".$color."-300
        ",
    ]) !!} >
    {{$slot}}
</a>