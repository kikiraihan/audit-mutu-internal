<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>

<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl">Instrumen AMI</h1>
        <span class="text-sm">Instrumen Audit Mutu Internal Dokumen</span>
        
        <div class="w-full pt-4">
            <div class="grid grid-cols-4 items-center">
                <div class="flex p-2 space-x-1 col-span-2">
                    <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                        <i class="fas fa-search mr-3"></i>
                    </button>
                    <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" class="w-full rounded p-2" />
                </div>

                @hasanyrole('Admin')
                <div class="text-right col-span-2 pr-2">
                    <x-atom.link-table-only-faicon icon="fas fa-plus" 
                        warna="emerald" class="px-2 py-1" 
                        href="{{ route('amidokumen.add') }}"/>
                </div>
                @endhasanyrole
            </div>

            @if ($isiTabel->isEmpty())
                <x-atom.empty-table/>
            @else
            <div class="bg-white overflow-auto rounded">
                <table class="min-w-full bg-white">
                    <thead class="bg-sky-700 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created at</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Judul</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Uraian</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Sub Uraian</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($isiTabel as $item)
                        <tr>
                            <td class="text-left py-3 px-4">{{$item->created_at->format('Y-m-d')}}</td>
                            <td class="text-left py-3 px-4">{{$item->judul}}</td>
                            <td class="text-center py-3 px-4">{{$item->uraians->count()}}</td>
                            <td class="text-center py-3 px-4">{{$item->suburaians->count()}}</td>
                            <td class="text-left py-3 px-4 flex justify-end space-x-2">
                                @hasanyrole('Admin')
                                <x-atom.link-table-only-faicon icon="fas fa-eye" 
                                warna="blue" class="px-2 py-1"
                                href="{{ route('amidokumen.detail', ['id'=>$item->id]) }}"/>
                                <x-atom.link-table-only-faicon icon="fas fa-edit" 
                                warna="yellow" class="px-2 py-1"
                                href="{{ route('amidokumen.edit', ['id'=>$item->id]) }}"/>
                                <x-atom.button-table-only-faicon icon="fas fa-trash" 
                                warna="red" class="px-2 py-1 float-right" 
                                wire:click="$emit('swalToDeleted','FixHapusAmidokumen','{{$item->id}}')"/>
                                @else
                                <x-atom.link-table-only-faicon icon="fas fa-eye" 
                                warna="blue" class="px-2 py-1"
                                href="{{ route('amidokumen.detail', ['id'=>$item->id]) }}"/>
                                @endhasanyrole
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