<header class="bg-indigo-400">
    <div class="flex justify-between py-1 items-center">
        <div class="px-3 inline-flex items-center text-white gap-4">
            <a href="{{ route('base') }}"><strong class="capitalize ml-1 flex-1">Sistem Audit Internal Mutu</strong></a>
            <span class="material-symbols-outlined cursor-pointer select-none"  onclick="sidebarToggle()">
                menu
            </span>
        </div>
        
        
        <div class="flex items-center gap-4 mr-8">
            
            <div class="flex flex-col text-right">
                <span class="text-white text-sm">
                    {{ Auth::user()->name }} 
                </span>
                <span class="text-white text-xs">
                    {{ Auth::user()->roles[0]->name }}
                </span>
            </div>

            <div x-data="{ isOpen: false }" class="flex justify-end">
                <button @click="isOpen = !isOpen" class="relative z-10 w-14 rounded-full overflow-hidden border-2 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{ asset('gambar/profile.png') }}" class="bg-slate-200">
                </button>
                {{-- <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed right-6 cursor-default"></button> --}}
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 right-8 top-16">
                    <a href="{{ route('profile.edit')}}" class="block text-sm px-4 py-2 account-link hover:bg-gray-100">Account</a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
        
                </div>
            </div>

        </div>
    </div>
</header>