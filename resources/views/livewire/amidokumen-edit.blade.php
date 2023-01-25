<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Edit AMI Dokumen</h1>
        <section class="w-full">
            
            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">

                    <div class="flex border-b border-40 mb-2">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Judul</h4>
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="ami.judul" placeholder="judul"/>
                            <x-atom.form-error-input :kolom="'ami.judul'" />
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        Uraian
                    </div>

                    @foreach ($ami->uraians as $index=>$item)
                        <div class="flex gap-3 py-2">
                            <div class="w-1/12">
                                <x-atom.form-input-standar wire:model="ami.uraians.{{ $index }}.nomor" placeholder="nomor" type="number"/>
                            </div> 
                            <div class="w-9/12 break-words">
                                <x-atom.form-input-standar wire:model="ami.uraians.{{ $index }}.isi" placeholder="isi"/>
                            </div>
                            <div class="w-2/12">
                                <x-atom.button-link class="p-1.5 inline-block items-center" :color="'red'" wire:click="hapusUraian('{{$item->id}}')">
                                    Hapus
                                </x-atom.button-link>

                                <x-atom.button-link class="p-2" :color="'emerald'" href="{{ route('amidokumen.edit.suburaian', ['id'=>$item->id]) }}">
                                    Sub
                                </x-atom.button-link>

                                {{-- <x-atom.button-link class="p-2" :color="'emerald'" wire:click="newSubUraian('{{$item->id}}')">
                                    Sub
                                </x-atom.button-link> --}}
                                
                            </div> 
                        </div>
                        <div>
                            <span class="error text-xs text-red-300">
                                @error('ami.uraians.'.$index.'.nomor') {{ $message }} @enderror
                            </span>
                            <span class="error text-xs text-red-300">
                                @error('ami.uraians.'.$index.'.isi') {{ $message }} @enderror
                            </span>
                        </div>

                        @foreach ($item->suburaians as $indexx=>$itemm)
                            <div class="flex gap-3 py-2">
                                <div class="w-1/12">
                                    
                                </div> 
                                <div class="w-10/12 break-words">
                                    {{$itemm->nomor}} - {{$itemm->isi}}
                                </div>
                                <div class="w-1/12">
                                    {{-- <x-atom.button-link class="p-1.5 inline-block items-center" :color="'red'" wire:click="hapusSubUraian('{{$itemm->id}}')">
                                        Hapus
                                    </x-atom.button-link> --}}
                                </div> 
                            </div>
                        @endforeach

                    @endforeach

                    <div class="flex space-x-2 mt-2">
                        <x-atom.button-link class="p-2" :color="'emerald'" wire:click="newUraian">
                            Tambah Uraian
                        </x-atom.button-link>
                    </div>



                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'"
                href="{{ route('amidokumen') }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>
    
    </main>
</div>

