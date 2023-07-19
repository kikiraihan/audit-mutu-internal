<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>

<div class="w-full overflow-x-hidden flex flex-col">
    <main class="w-full flex-grow p-6">

        <h1 class="text-3xl text-black pb-4">Edit Profile</h1>
        <section class="w-full">

            <form wire:submit.prevent="save" enctype='multipart/form-data'>
                <div class="bg-white overflow-auto mb-6 py-3 px-6 rounded">

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Name</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="name" placeholder="name" />
                            <x-atom.form-error-input :kolom="'name'" />
                        </div>
                    </div>

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Username</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="username" placeholder="username" />
                            <x-atom.form-error-input :kolom="'username'" />
                        </div>
                    </div>

                    <div class="flex border-b border-40">
                        <div class="w-1/4 py-4">
                            <h4 class="font-normal text-80">Password</h4>
                        </div>
                        <div class="w-3/4 py-4 break-words">
                            <x-atom.form-input-standar wire:model="password" placeholder="password" type="password"/>
                            <x-atom.form-error-input :kolom="'password'" />
                        </div>
                    </div>


                </div>
            </form>

            <div class="flex justify-end space-x-2">
                <x-atom.button-manual class="p-2" :color="'emerald'" wire:click="save">
                    Simpan
                </x-atom.button-manual>
            </div>

        </section>

    </main>
</div>