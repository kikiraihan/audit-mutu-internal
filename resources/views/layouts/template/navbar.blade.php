<header class="bg-indigo-400">
    <div class="flex justify-between py-1">
        <div class="px-3 inline-flex items-center text-white gap-4">
            <a href="{{ route('base') }}"><strong class="capitalize ml-1 flex-1">Sistem Audit Internal Mutu</strong></a>
            <span class="material-symbols-outlined cursor-pointer select-none"  onclick="sidebarToggle()">
                menu
            </span>
        </div>
        
        <div class="flex items-center p-1 ">
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="relative z-10 w-24  rounded-full overflow-hidden border-2 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{ asset('gambar/profile.png') }}" class="bg-slate-200">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    {{-- <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a> --}}
        
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