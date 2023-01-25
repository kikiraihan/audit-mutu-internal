<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Tim Auditor Form AMI</h1>

        <div class="w-full pt-4">
    
            @if ($isiTabel->isEmpty())
                <x-atom.empty-table/>
            @else
            <div class="bg-white overflow-auto rounded">
                <table class="min-w-full bg-white">
                    <thead class="bg-sky-700 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($isiTabel as $item)
                        <tr>
                            <td class="text-left py-3 px-4">{{$item->user->name}}</td>
                            <td class="text-center py-3 px-4">{{$item->status}}</td>
                            <td class="text-left py-3 px-4 flex justify-end space-x-2">
                                <x-atom.button-table-only-faicon icon="fas fa-trash" 
                                    warna="red" class="px-2 py-1 float-right" 
                                    wire:click="$emit('swalToDeleted','FixHapusAuditorAmi','{{$item->id}}')"/>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <h1 class="text-2xl text-black mt-8">Tambah</h1>
        <section class="min-w-fit">
            
            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-slate-100 overflow-auto mb-6 py-3 px-6 rounded">


                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80 mb-2">Auditor :</h4>
                            @if ($dipilih)
                                <div class="bg-blue-200 text-md px-3 py-2 rounded">
                                    <span>{{$dipilih->name}}</span>
                                </div>
                            @endif
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            
                            <div class="flex p-2 space-x-1 col-span-2">
                                <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                                    <i class="fas fa-search mr-3"></i>
                                </button>
                                <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" class="w-full rounded p-2" />
                            </div>
                            @if ($select->isEmpty())
                                <x-atom.empty-table/>
                            @else
                                <ul class="ml-8 px-6 divide-y-2 divide-gray-100">
                                    @foreach ($select as $au)
                                    <li class="py-3 space-x-3 flex">
                                        <div wire:click="pilih({{json_encode($au->id)}})" 
                                            class="bg-blue-200  px-3 py-1 rounded cursor-pointer hover:bg-blue-300 shadow">
                                            <i class="fas fa-user text-sm pr-1"></i>
                                            <span>{{$au->name}}</span>
                                        </div>
                                    </li>     
                                    @endforeach
                                </ul>
                            @endif
                            <div class="px-3 py-2">
                                {{ $select->links() }}
                            </div>
    
                            <x-atom.form-error-input :kolom="'au.id_user_auditor'" />
                        </div>
                    </div>

                    <div class="flex ">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Status</h4>
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-select-standar wire:model="au.status">
                                <option value="" hidden selected>[belum dipilih]</option>
                                @foreach ([
                                    'Anggota',
                                    'Ketua',
                                ] as $item)
                                    <option class="w-full capitalize" value='{{$item}}'>
                                        {{$item}}
                                    </option>
                                @endforeach
                            </x-atom.form-select-standar>
                            <x-atom.form-error-input :kolom="'au.status'" />
                        </div>
                    </div>

                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'"
                href="{{ route('formAmiDokumen') }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>
    
    </main>
</div>

