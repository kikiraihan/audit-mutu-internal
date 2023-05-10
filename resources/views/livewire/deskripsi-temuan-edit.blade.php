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
                            <h4 class="font-normal text-80">akar_penyebab</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.akar_penyebab" placeholder="akar_penyebab" />
                            <x-atom.form-error-input :kolom="'data.akar_penyebab'" />
                        </div>
                    </div>

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">akibat</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.akibat" placeholder="akibat" />
                            <x-atom.form-error-input :kolom="'data.akibat'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">rekomendasi</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.rekomendasi" placeholder="rekomendasi" />
                            <x-atom.form-error-input :kolom="'data.rekomendasi'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">tanggapan_auditee</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.tanggapan_auditee"
                                placeholder="tanggapan_auditee" />
                            <x-atom.form-error-input :kolom="'data.tanggapan_auditee'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">rencana_perbaikan</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.rencana_perbaikan"
                                placeholder="rencana_perbaikan" />
                            <x-atom.form-error-input :kolom="'data.rencana_perbaikan'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">jadwal_perbaikan</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.jadwal_perbaikan"
                                placeholder="jadwal_perbaikan" />
                            <x-atom.form-error-input :kolom="'data.jadwal_perbaikan'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">pj_perbaikan</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.pj_perbaikan" placeholder="pj_perbaikan" />
                            <x-atom.form-error-input :kolom="'data.pj_perbaikan'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">rencana_pencegahan</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.rencana_pencegahan"
                                placeholder="rencana_pencegahan" />
                            <x-atom.form-error-input :kolom="'data.rencana_pencegahan'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">pj_pencegahan</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.pj_pencegahan" placeholder="pj_pencegahan" />
                            <x-atom.form-error-input :kolom="'data.pj_pencegahan'" />
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">jadwal_pencegahan</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.jadwal_pencegahan"
                                placeholder="jadwal_pencegahan" />
                            <x-atom.form-error-input :kolom="'data.jadwal_pencegahan'" />
                        </div>
                    </div>


                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'" href="{{ route('deskripsiTemuan') }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>

    </main>
</div>