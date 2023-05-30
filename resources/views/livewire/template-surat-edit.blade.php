<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Edit template surat</h1>
        <section class="w-full">
            
            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">

                    <div class="flex">
                    <div class="w-1/4 py-4">
                        <h4 class="font-normal text-80">
                            File
                        </h4>
                        <div class="text-gray-400 text-xs">*maksimal 1mb</div>
                        <div class="text-gray-400 text-xs">*format .doc/.docx</div>
                    </div> 
                    @if ($data->file and !$file)
                        <div class="shadow my-4 flex-row flex items-center gap-4 px-2">
                            <a href="{{ $data->file }}" target="_blank" class="flex items-center gap-2 hover:text-blue-800 ">
                                <i class="fas fa-file-word md:text-4xl text-6xl text-blue-500"></i>
                                <span class="hidden md:inline">
                                    {{ $data->getRawOriginal('file') }}
                                </span>
                            </a>
                            <div>
                                <x-atom.button-table-only-faicon icon="fas fa-trash" 
                                    warna="red" class="px-2 py-1 float-right" 
                                    wire:click="hapusFileLama"/>
                            </div>
                        </div>
                    @else
                    <div class="w-3/4 py-4 break-words"
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <x-atom.form-input-standar wire:model="file" type="file"/>
                            <x-atom.form-error-input :kolom="'file'" />
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress" class="w-full animate-pulse"></progress>
                            </div>
                    </div>
                    @endif
                </div>
                @if ($file)
                <div class="w-1/2">
                    file Preview:
                    {{-- <div>{{ $file->temporaryUrl() }}</div> --}}
                    {{-- <img class="w-1/2" src="{{ $file->temporaryUrl() }}"> --}}
                </div>
                @endif

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Title</h4>
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.title" placeholder="title"/>
                            <x-atom.form-error-input :kolom="'data.title'" />
                        </div>
                    </div>

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Keterangan</h4>
                        </div> 
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="data.keterangan" placeholder="keterangan"/>
                            <x-atom.form-error-input :kolom="'data.keterangan'" />
                        </div>
                    </div>

                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'"
                href="{{ route('templateSurat') }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>
    
    </main>
</div>

