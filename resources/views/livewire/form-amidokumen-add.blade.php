<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Tambah Form AMI Dokumen</h1>
        <section class="w-full">
            
            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80 mb-2">AMI :</h4>
                            @if ($dipilihAmi)
                                <div class="bg-blue-200 text-md px-3 py-2 rounded">
                                    <span>
                                        <x-atom.button-table-only-faicon icon="fas fa-times" 
                                        warna="stone" class="px-2 py-1 float-right" 
                                        wire:click="batalAmi"/>
                                    </span>
                                    <span>{{$dipilihAmi->judul}}</span>
                                </div>
                            @endif
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            
                            <div class="flex p-2 space-x-1 col-span-2">
                                <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                                    <i class="fas fa-search mr-3"></i>
                                </button>
                                <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="searchAmi" class="w-full rounded p-2" />
                            </div>
                            @if ($selectAmi->isEmpty())
                                <x-atom.empty-table/>
                            @else
                                <ul class="ml-8 px-6 divide-y-2 divide-gray-100">
                                    @foreach ($selectAmi as $au)
                                    <li class="py-3 space-x-3 flex">
                                        <div wire:click="pilihAmi({{json_encode($au->id)}})" 
                                            class="bg-blue-200  px-3 py-1 rounded cursor-pointer hover:bg-blue-300 shadow">
                                            <i class="fas fa-list-alt text-sm pr-1"></i>
                                            <span>{{$au->judul}}</span>
                                        </div>
                                    </li>     
                                    @endforeach
                                </ul>
                            @endif
                            <div class="px-3 py-2">
                                {{ $selectAuditee->links() }}
                            </div>
    
                            <x-atom.form-error-input :kolom="'form.id_ami_dokumen'" />
                        </div>
                    </div>


                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Ruang Lingkup</h4>
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="form.ruang_lingkup" placeholder="Ruang lingkup"/>
                            <x-atom.form-error-input :kolom="'form.ruang_lingkup'" />
                        </div>
                    </div>

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80 mb-2">Auditee :</h4>
                            @if ($dipilihAuditee)
                                <div class="bg-blue-200 text-md px-3 py-2 rounded">
                                    <span>
                                        <x-atom.button-table-only-faicon icon="fas fa-times" 
                                        warna="stone" class="px-2 py-1 float-right" 
                                        wire:click="batalAuditee"/>
                                    </span>
                                    <span>{{$dipilihAuditee->name}}</span>
                                </div>
                            @endif
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            
                            <div class="flex p-2 space-x-1 col-span-2">
                                <button class="w-auto flex justify-end items-center text-gray-500 p-2 hover:text-gray-400">
                                    <i class="fas fa-search mr-3"></i>
                                </button>
                                <x-atom.form-input-standar placeholder="Search" type="text" wire:model.debounce.500ms="searchAuditee" class="w-full rounded p-2" />
                            </div>
                            @if ($selectAuditee->isEmpty())
                                <x-atom.empty-table/>
                            @else
                                <ul class="ml-8 px-6 divide-y-2 divide-gray-100">
                                    @foreach ($selectAuditee as $au)
                                    <li class="py-3 space-x-3 flex">
                                        <div wire:click="pilihAuditee({{json_encode($au->id)}})" 
                                            class="bg-blue-200  px-3 py-1 rounded cursor-pointer hover:bg-blue-300 shadow">
                                            <i class="fas fa-user text-sm pr-1"></i>
                                            <span>{{$au->name}}</span>
                                        </div>
                                    </li>     
                                    @endforeach
                                </ul>
                            @endif
                            <div class="px-3 py-2">
                                {{ $selectAuditee->links() }}
                            </div>
    
                            <x-atom.form-error-input :kolom="'form.id_user_auditee'" />
                        </div>
                    </div>

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Wakil auditee</h4>
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="form.wakil_auditee" placeholder="Nama beserta gelar"/>
                            <x-atom.form-error-input :kolom="'form.wakil_auditee'" />
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

