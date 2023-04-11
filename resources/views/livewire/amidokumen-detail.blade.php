<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Detail Instrumen AMI</h1>
        <section class="w-full">
            
            <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded text-justify">

                <div class="flex border-b border-40 mb-2">
                    <div class="w-1/4 py-4">
                        <h4 class="font-normal text-80">Judul</h4>
                    </div> 
                    <div class="w-3/4 py-4 break-words">
                        {{$ami->judul}}
                    </div>
                </div>

                <div class="flex space-x-2">
                    Uraian
                </div>

                @foreach ($ami->uraians as $index=>$item)
                    <div class="flex py-2">
                        <div class="w-1/12">
                            {{$item->nomor}}
                        </div> 
                        <div class="w-11/12 break-words">
                            {{$item->isi}}
                        </div>
                    </div>

                    @foreach ($item->suburaians as $indexx=>$itemm)
                        <div class="flex gap-3 py-2">
                            <div class="w-1/12">
                            </div> 
                            <div class="w-10/12 break-words flex">
                                <span class="mr-1">
                                    {{$itemm->nomor}}.
                                </span> 
                                <span>
                                    {{$itemm->isi}}
                                </span>
                            </div>
                            <div class="w-1/12">
                                {{-- <x-atom.button-link class="p-1.5 inline-block items-center" :color="'red'" wire:click="hapusSubUraian('{{$itemm->id}}')">
                                    Hapus
                                </x-atom.button-link> --}}
                            </div> 
                        </div>
                    @endforeach

                @endforeach



            </div>


            <div class="flex justify-end space-x-2">
                <x-atom.button-link class="p-2" :color="'zinc'"
                href="{{ route('amidokumen') }}">
                    Kembali
                </x-atom.button-link>
            </div>

        </section>
    
    </main>
</div>

