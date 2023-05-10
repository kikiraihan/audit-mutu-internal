<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>

<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl">Deskripsi temuan KTS</h1>
        <span class="text-sm">Daftar temuan KTS yang perlu diberikan deskripsi</span>

        <div class="w-full pt-4">
            <div class="grid grid-cols-4 items-center">
                <div class="flex p-2 space-x-1 col-span-2">
                    <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                        <i class="fas fa-search mr-3"></i>
                    </button>
                    <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search"
                        class="w-full rounded p-2" />
                </div>

                @hasanyrole('Admin')
                <div class="text-right col-span-2 pr-2">
                    <x-atom.link-table-only-faicon icon="fas fa-plus" warna="emerald" class="px-2 py-1"
                        href="{{ route('amidokumen.add') }}" />
                </div>
                @endhasanyrole
            </div>

            @if ($isiTabel->isEmpty())
            <x-atom.empty-table />
            @else
            <div class="bg-white overflow-auto rounded">
                <table class="min-w-full bg-white">
                    <thead class="bg-sky-700 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created at</th>
                            {{-- <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Dokumen AMI</th> --}}
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Auditee</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Deskripsi</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">status</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($isiTabel as $item)
                        <tr>
                            <td class="text-left py-3 px-4">{{$item->created_at->format('Y-m-d')}}</td>
                            {{-- <td class="text-center py-3 px-4 text-xs">
                                {{$item->jawabanable->amiDokumen->judul}}
                            </td> --}}
                            <td class="text-center py-3 px-4">
                                {{$item->formAmiDokumen->auditee->name}}
                            </td>
                            <td class="text-left py-3 px-4 text-xs">{{$item->deskripsi}}</td>
                            <td class="text-center py-3 px-4">
                                @if ($item->deskripsiTemuan)
                                <x-atom.badge class="bg-slate-100 rounded">
                                    sudah
                                </x-atom.badge>
                                @endif
                            </td>
                            <td class="text-center py-3 px-4 flex justify-end space-x-2">
                                @if (!$item->deskripsiTemuan)
                                <x-atom.link-table-only-faicon icon="fas fa-plus" warna="green" class="px-2 py-1"
                                    href="{{ route('deskripsiTemuan.add', ['id'=>$item->id]) }}" />
                                @else
                                <x-atom.link-table-only-faicon icon="fas fa-edit" warna="yellow" class="px-2 py-1"
                                    href="{{ route('deskripsiTemuan.edit', ['id'=>$item->deskripsiTemuan->id]) }}" />
                                <x-atom.button-table-only-faicon icon="fas fa-trash" warna="red"
                                    class="px-2 py-1 float-right"
                                    wire:click="$emit('swalToDeleted','FixHapusDeskripsi','{{$item->deskripsiTemuan->id}}')" />
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