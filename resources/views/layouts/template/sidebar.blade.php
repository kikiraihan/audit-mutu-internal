<aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
    <div class="list-reset flex flex-col">

        @foreach ([
        ['route' => 'dashboard', 'title' => 'Dashboard','icon'=>'fas fa-tachometer-alt mr-3'],
        ] as $item)
        <a href="{{ route($item['route']) }}"
            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline w-full h-full py-3 px-2 border-b border-light-border flex justify-between @if(request()->routeIs($item['route'])) bg-white @else @endif">
            <span class="flex items-center">
                <i class="{{$item['icon']}} float-left mx-2"></i>
                {{$item['title']}}
            </span>
            <span class="flex items-center">
                <i class="fas fa-angle-right float-right"></i>
            </span>
        </a>
        @endforeach

        @hasanyrole('Admin')
        @foreach ([
        ['route' => 'amidokumen', 'title' => 'Instrumen AMI','icon'=>'fas fa-table mr-3'],
        ['route' => 'formAmiDokumen', 'title' => 'Audit Dokumen','icon'=>'fas fa-list-alt mr-3'],
        ['route' => 'user', 'title' => 'Users','icon'=>'fas fa-users mr-3'],
        ] as $item)
        <a href="{{ route($item['route']) }}"
            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline w-full h-full py-3 px-2 border-b border-light-border flex justify-between @if(request()->routeIs($item['route'])) bg-white @else @endif">
            <span class="flex items-center">
                <i class="{{$item['icon']}} float-left mx-2"></i>
                {{$item['title']}}
            </span>
            <span class="flex items-center">
                <i class="fas fa-angle-right float-right"></i>
            </span>
        </a>
        @endforeach
        @endhasanyrole

        @hasanyrole('Auditee')
        @foreach ([
        ['route' => 'jawabanAmiDokumen', 'title' => 'Audit Dokumen saya','icon'=>'fas fa-list-alt mr-3'],
        ] as $item)
        <a href="{{ route($item['route']) }}"
            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline w-full h-full py-3 px-2 border-b border-light-border flex justify-between @if(request()->routeIs($item['route'])) bg-white @else @endif">
            <span class="flex items-center">
                <i class="{{$item['icon']}} float-left mx-2"></i>
                {{$item['title']}}
            </span>
            <span class="flex items-center">
                <i class="fas fa-angle-right float-right"></i>
            </span>
        </a>
        @endforeach
        @endhasanyrole

        @hasanyrole('Auditor')
        @foreach ([
        ['route' => 'amidokumen', 'title' => 'Instrumen AMI','icon'=>'fas fa-table mr-3'],
        ['route' => 'auditorAmidokumen', 'title' => 'Data Audit','icon'=>'fas fa-list-alt mr-3'],
        ['route' => 'deskripsiTemuan', 'title' => 'Deskripsi Temuan','icon'=>'fas fa-list-alt mr-3'],
        ] as $item)
        <a href="{{ route($item['route']) }}"
            class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline w-full h-full py-3 px-2 border-b border-light-border flex justify-between @if(request()->routeIs($item['route'])) bg-white @else @endif">
            <span class="flex items-center">
                <i class="{{$item['icon']}} float-left mx-2"></i>
                {{$item['title']}}
            </span>
            <span class="flex items-center">
                <i class="fas fa-angle-right float-right"></i>
            </span>
        </a>
        @endforeach
        @endhasanyrole

    </div>

</aside>