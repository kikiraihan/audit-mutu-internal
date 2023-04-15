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
            <h1 class="text-3xl text-black pb-4">Jawaban Audit Dokumen</h1>
        </div>

        <section class="w-full">
            <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded text-justify">
                @php
                    $recent=null;
                @endphp


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
                            <div class="w-6/12 py-4 break-words">
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
                        <div class="w-1/12 p-4 break-words text-center">
                            @if ($item->jawaban=='1')
                                <x-atom.badge class="bg-green-200 rounded capitalize">
                                    Ya
                                </x-atom.badge>
                            @elseif ($item->jawaban=='0')
                                <x-atom.badge class="bg-red-200 rounded capitalize">
                                    Tidak
                                </x-atom.badge>
                            @else
                                <x-atom.badge class="bg-slate-200 rounded capitalize">
                                    Kosong
                                </x-atom.badge>
                            @endif
                        </div>
                        <div class="w-4/12 p-4 break-words text-xs">
                            Catatan auditee : <br>{{$item->catatan?$item->catatan:'-'}}
                        </div>
                    </div>


                    @if ($item->kts!='belum')
                        <div class="flex border-b border-40 bg-green-50 justify-between items-center">
                            <div class="w-1/12 p-4 text-xs text-gray-500">auditor :</div>
                            <div class="w-1/12 p-4 break-words text-center">
                                @if ($item->kts=='ob')
                                    <x-atom.badge class="bg-green-200 rounded capitalize">
                                        observasi
                                    </x-atom.badge>
                                @elseif ($item->kts=='kts')
                                    <x-atom.badge class="bg-red-200 rounded capitalize">
                                        ketidaksesuaian
                                    </x-atom.badge>
                                @else
                                    <x-atom.badge class="bg-slate-200 rounded capitalize">
                                        Belum
                                    </x-atom.badge>
                                @endif
                            </div>
                            <div class="w-9/12 p-4 break-words text-xs">
                                {{$item->deskripsi?$item->deskripsi:'-'}}
                            </div>
                        </div>
                    @endif

                @endforeach


            </div>

            <div class="flex justify-end space-x-2">
                @hasanyrole('Auditee')
                    <x-atom.button-link class="p-2" :color="'zinc'"
                    href="{{ route('jawabanAmiDokumen') }}">
                        Kembali
                    </x-atom.button-link>
                @endhasanyrole
                @hasanyrole('Auditor')
                    <x-atom.button-link class="p-2" :color="'zinc'"
                    href="{{ route('auditorAmidokumen') }}">
                        Kembali
                    </x-atom.button-link>
                @endhasanyrole
            </div>

        </section>
    
    </main>
</div>

