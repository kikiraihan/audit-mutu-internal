<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Sub Uraian</h1>
        <section class="w-full">
            
            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">

                    @foreach ($ur->suburaians as $index=>$item)
                        <div class="flex gap-3 py-2">
                            <div class="w-1/12">
                                <x-atom.form-input-standar wire:model="ur.suburaians.{{ $index }}.nomor" placeholder="nomor"/>
                            </div> 
                            <div class="w-9/12 break-words">
                                <x-atom.form-input-standar wire:model="ur.suburaians.{{ $index }}.isi" placeholder="isi"/>
                            </div>
                            <div class="w-2/12">
                                <x-atom.button-link class="p-1.5 inline-block items-center" :color="'red'" wire:click="hapusSubUraians('{{$item->id}}')">
                                    Hapus
                                </x-atom.button-link>
                                
                            </div> 
                        </div>
                        <div>
                            <span class="error text-xs text-red-300">
                                @error('ur.suburaians.'.$index.'.nomor') {{ $message }} @enderror
                            </span>
                            <span class="error text-xs text-red-300">
                                @error('ur.suburaians.'.$index.'.isi') {{ $message }} @enderror
                            </span>
                        </div>

                    @endforeach

                    <div class="flex space-x-2 mt-2">
                        <x-atom.button-link class="p-2" :color="'emerald'" wire:click="newSubUraian">
                            Tambah SubUraians
                        </x-atom.button-link>
                    </div>


                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'"
                href="{{ route('amidokumen.edit', ['id'=>$ur->amiDokumen->id]) }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>
    
    </main>
</div>

