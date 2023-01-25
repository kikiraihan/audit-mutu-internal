<div class="bg-white overflow-auto rounded text-center text-sm py-5">
    {{-- <-kosong-> --}}
    {{-- @php
        $a=[
            'kosong_spotlight.svg',
            'kosong_inbox.svg',
            'kosong.svg',
        ];
        $random_keys=array_rand($a,1);
        .$a[$random_keys]
    @endphp --}}
    <img class="saturate-50 opacity-60 d-block mr-auto ml-auto" src="{{asset('gambar/kosong_inbox.svg')}}" alt="kosong" width="15%">
    <h5 class="text-lg">Data</h5>
    <span class="text-sm">tidak ditemukan</span>

    <div class="pt-2">
        {{$slot}}
    </div>
</div>