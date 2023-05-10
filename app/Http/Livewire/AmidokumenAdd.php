<?php

namespace App\Http\Livewire;

use App\Models\AmiDokumen;
use Livewire\Component;

class AmidokumenAdd extends Component
{
    public AmiDokumen $ami;

    public function mount()
    {
        $this->ami = new AmiDokumen;
    }

    protected $rules = [
        'ami.judul' => 'required', //string
    ];

    public function save()
    {
        // dd($this->news);
        $this->validate();
        $this->ami->save();

        $this->mount();
        $this->emit('swalAdded');
    }


    public function render()
    {
        return view('livewire.amidokumen-add');
    }
}
