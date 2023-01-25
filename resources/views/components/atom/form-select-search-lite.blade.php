@props([
    'terpilih'=>'...',
    ])


<div class="relative" x-data="{ open: false }">

    <button type="button" x-on:click="open = ! open" class="cursor-pointer p-2 bg-white shadow text-sm border-none w-full rounded flex justify-between focus:outline-none focus:ring-2 focus:ring-blue-300">
        <span>
            {{$terpilih}}
        </span>
        <i class="fas fa-angle-down"></i>
    </button>

    <div x-show="open"
    class="rounded shadow-md my-2 absolute pin-t pin-l bg-gray-50 w-full z-20">
        <ul class="list-reset">
            <li class="p-2">
                <input 
                    {!! $attributes->merge([
                        "class"=>"border-2 rounded h-8 w-full px-2",
                        'placeholder'=>"Cari",
                        'type'=>"text",
                    ]) !!} >
                <br>
            </li>
            {{$slot}}
        </ul>
    </div>

</div>