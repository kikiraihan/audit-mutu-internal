<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>

<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl">Audit Dokumen</h1>
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
                    <x-atom.link-table-only-faicon icon="fas fa-plus" 
                        warna="emerald" class="px-2 py-1" 
                        href="{{ route('templateSurat.add') }}"/>
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
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Keterangan</th>
                            <th class="text-right py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($isiTabel as $item)
                        <tr>
                            <td class="text-left py-3 px-4">{{$item->created_at->diffForHumans()}}</td>
                            <td class="text-left py-3 px-4">{{$item->title}}</td>
                            <td class="text-left py-3 px-4">{{$item->keterangan}}</td>
                            <td class="text-right py-3 px-4 flex justify-end space-x-2">
                                <x-atom.link-table-only-faicon icon="fas fa-download" warna="green" class="px-2 py-1" href="{{ $item->file }}" target="_blank"/>
                                <x-atom.link-table-only-faicon icon="fas fa-pen" warna="yellow" class="px-2 py-1" href="{{ route('templateSurat.edit', ['id'=>$item->id]) }}"/>
                                <x-atom.button-table-only-faicon icon="fas fa-trash" warna="red" class="px-2 py-1 float-right" wire:click="$emit('swalToDeleted','FixHapusTemplateSurat','{{$item->id}}')" />
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