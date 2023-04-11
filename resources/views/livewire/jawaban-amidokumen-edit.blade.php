<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-4">Edit Jawaban Audit Dokumen</h1>
            <div class="space-x-2 mt-2 mr-8">
                <x-atom.button-link :color="'emerald'" wire:click="refreshJawaban">
                    Refresh
                </x-atom.button-link>
            </div>
        </div>

        <section class="w-full">
            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">
                    @php
                        $recent=null;
                    @endphp

                    {{-- {{App\Models\Uraian::find($item->jawabanable->id_uraian)->nomor}} --}} 
                    @foreach ($jawabans as $index=>$item)
                        @if ($item->jawabanable_type=='App\Models\SubUraian' and $recent!=$item->jawabanable->id_uraian)
                            @php 
                                $recent=$item->jawabanable->id_uraian ;
                                $uraian=App\Models\Uraian::find($item->jawabanable->id_uraian);
                            @endphp
                            <div class="flex border-b border-40">
                                <div class="w-1/12 p-4 flex justify-between">
                                    {{$uraian->nomor}} 
                                </div>
                                <div class="w-9/12 py-4 break-words">
                                    {{$uraian->isi}}
                                </div>
                            </div>

                        @endif
                        <div class="flex border-b border-40">
                            <div class="w-1/12 p-4 flex justify-between">
                                <span>
                                        @if ($item->jawabanable_type=='App\Models\Uraian') {{$item->jawabanable->nomor}}.@endif
                                </span>
                                <span>
                                        @if ($item->jawabanable_type=='App\Models\SubUraian') {{$item->jawabanable->nomor}}. @endif
                                </span>
                            </div> 
                            <div class="w-6/12 py-4 break-words">
                                {{$item->jawabanable->isi}}
                            </div>
                            <div class="w-1/12 p-4 break-words">
                                <x-atom.form-select-standar wire:model="jawabans.{{$index}}.jawaban">
                                    <option value="" selected>...</option>
                                    @foreach ([
                                        [1,'ya'],
                                        [0,'tidak'],
                                    ] as $item)
                                        <option class="w-full capitalize" value='{{$item[0]}}'>
                                            {{$item[1]}}
                                        </option>
                                    @endforeach
                                </x-atom.form-select-standar>
                                <x-atom.form-error-input :kolom="'jawabans.{{$index}}.jawaban'" />
                            </div>
                            <div class="w-4/12 p-4 break-words">
                                <x-atom.form-input-standar wire:model="jawabans.{{$index}}.catatan" placeholder="catatan"/>
                                <x-atom.form-error-input :kolom="'jawabans.{{$index}}.catatan'" />
                            </div>
                        </div>
                    @endforeach


                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'"
                href="{{ route('jawabanAmiDokumen') }}">
                    Kembali
                </x-atom.button-link>
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>
    
    </main>
</div>

