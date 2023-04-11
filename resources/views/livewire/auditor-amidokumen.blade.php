<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>

<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl">Data Audit</h1>
        <span class="text-sm">Dokumen Audit Mutu Internal dan hasil audit dilapangan</span>
        
        <div class="w-full pt-4">
            <div class="grid grid-cols-4 items-center">
                <div class="flex p-2 space-x-1 col-span-2">
                    <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                        <i class="fas fa-search mr-3"></i>
                    </button>
                    <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" class="w-full rounded p-2" />
                </div>

                <div class="text-right col-span-2 pr-2">
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
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Auditee</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Tim Auditor</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($isiTabel as $item)
                        <tr>
                            <td class="text-left py-3 px-4">{{$item->created_at->diffForHumans()}}</td>
                            <td class="text-left py-3 px-4 text-xs">{{$item->amiDokumen->judul}}</td>
                            <td class="text-left py-3 px-4">{{$item->auditee->name}}</td>
                            <td class="text-center py-3 px-4 flex flex-row justify-center">
                                @forelse ($item->timAuditors as $au)
                                    <x-atom.badge class="bg-slate-100 rounded">
                                        {{$au->name}} | {{$au->pivot->status}} 
                                    </x-atom.badge>
                                @empty
                                    Belum ada auditor
                                @endforelse
                            </td>
                            <td class="text-center py-3 px-4">
                                <span class="capitalize mr-2 text-xs">
                                    {{$item->status}}
                                </span>
                            </td>
                            <td class="text-left py-3 px-4 flex justify-end space-x-2">
                                @if ($item->status!="selesai")
                                    <x-atom.link-table-only-faicon icon="fas fa-eye" warna="blue" class="px-2 py-1"
                                    href="{{ route('auditorAmidokumen.detail', ['id'=>$item->id]) }}"/>
                                    <x-atom.link-table-only-faicon icon="fas fa-pen-alt" warna="orange" class="px-2 py-1"
                                    href="{{ route('auditorAmidokumen.edit', ['id'=>$item->id]) }}"/>

                                    {{-- <x-atom.button-table-with-faicon icon="fas fa-check" warna="green"  class="px-2 py-1" wire:click="$emit('swalAndaYakin','FixSelesaiJawabanAmiDokumen','{{$item->id}}','anda akan menyelesaikan pengisian dan tidak dapat diubah lagi. Apakah anda sudah memastikan data sudah benar?')">
                                        Selesaikan
                                    </x-atom.button-table-with-faicon> --}}
                                @else
                                    <x-atom.badge class="bg-green-200 rounded">
                                        Selesai diperiksa
                                    </x-atom.badge>

                                    {{-- <x-atom.button-table-with-faicon icon="fas fa-times" warna="rose"  class="px-2 py-1" wire:click="$emit('swalAndaYakin','FixBatalSelesaiJawabanAmiDokumen','{{$item->id}}','anda akan membatalkan status selesai, dan menarik kembali')">
                                        Batal selesai
                                    </x-atom.button-table-with-faicon> --}}
                                @endif
                                
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