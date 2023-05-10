<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Tambah AMI Dokumen</h1>
        <section class="w-full">

            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Judul</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="ami.judul" placeholder="judul" />
                            <x-atom.form-error-input :kolom="'ami.judul'" />
                        </div>
                    </div>


                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'" href="{{ route('amidokumen') }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>

    </main>
</div>