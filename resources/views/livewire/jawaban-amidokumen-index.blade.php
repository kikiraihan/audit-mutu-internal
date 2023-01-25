<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>

<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl">Form AMI Dokumen</h1>
        <span class="text-sm">Formulir pengisian Dokumen Audit Mutu Internal</span>
        
        <div class="w-full pt-4">
            <div class="grid grid-cols-4 items-center">
                <div class="flex p-2 space-x-1 col-span-2">
                    <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                        <i class="fas fa-search mr-3"></i>
                    </button>
                    <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" class="w-full rounded p-2" />
                </div>

                <div class="text-right col-span-2 pr-2">
                    {{-- <x-atom.link-table-only-faicon icon="fas fa-plus" 
                        warna="emerald" class="px-2 py-1" 
                        href="{{ route('formAmiDokumen.add') }}"/> --}}
                </div>
            </div>

            @if ($isiTabel->isEmpty())
                <x-atom.empty-table/>
            @else
            <div class="bg-white overflow-auto rounded">
                <table class="min-w-full bg-white">
                    <thead class="bg-sky-700 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created at</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Dokumen AMI</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Auditor</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($isiTabel as $item)
                        <tr>
                            <td class="text-left py-3 px-4">{{$item->created_at->diffForHumans()}}</td>
                            <td class="text-left py-3 px-4">{{$item->amiDokumen->judul}}</td>
                            <td class="text-center py-3 px-4">
                                @foreach ($item->timAuditors as $au)
                                    <span>{{$au->name}} | {{$au->pivot->status}} </span>
                                @endforeach
                            </td>
                            <td class="text-left py-3 px-4 flex justify-end space-x-2">
                                <x-atom.link-table-with-faicon icon="fas fa-pen-alt" 
                                    warna="blue" class="px-2 py-1"
                                    href="{{ route('jawabanAmiDokumen.edit', ['id'=>$item->id]) }}">
                                    Jawaban
                                </x-atom.link-table-with-faicon>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-3 py-2">
                    {{ $isiTabel->links() }}
                </div>
            </div>
            @endif
        </div>
    </main>

    
</div>