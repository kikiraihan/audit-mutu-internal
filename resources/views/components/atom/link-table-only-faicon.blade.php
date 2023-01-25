@props([
    'warna'=>'gray',
    'rounded'=>'',
    'icon'=>'fas fa-check',
    ])

<a
{!! $attributes->merge([
    'class'=>"shadow rounded".$rounded." focus:outline-none focus:ring-2 truncate inline-flex  gap-2 hover:bg-".$warna."-200 focus:ring-blue-300 text-".$warna."-600 bg-".$warna."-100",
]) !!} >
        <i class="{{$icon}}"></i>
</a>