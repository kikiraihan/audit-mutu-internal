@props([
    'warna' => 'blue',
])

<!-- component -->
<div class="w-full h-full fixed block top-0 left-0 bg-gray-100 opacity-70 z-50">
        <div class="d-block mr-auto ml-auto top-1/4 block relative">
            <img class="saturate-50 opacity-80  animate-pulse mx-auto" src="{{asset('gambar/Loading_Outline.svg')}}">
            <div class="animate-pulse text-gray-800 text-center">
                Tunggu..
            </div>
        </div>
</div>