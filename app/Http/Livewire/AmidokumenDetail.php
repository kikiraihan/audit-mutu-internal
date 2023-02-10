<?php

namespace App\Http\Livewire;

use App\Models\AmiDokumen;
use Livewire\Component;

class AmidokumenDetail extends Component
{
    public $idTo;
    public AmiDokumen $ami;

    protected $rules = [
        'ami.judul' => 'required',//string
        'ami.uraians.*.nomor' => 'required',
        'ami.uraians.*.isi' => 'required',
    ];

    public function mount($id)
    {
        $this->ami=AmiDokumen::find($id);
        $this->idTo = $id;
    }

    public function render()
    {
        return view('livewire.amidokumen-detail');
    }

    public function save()
    {
        return $this->emit('swalMessageError','tidak diizinkan mengubah data');
    }
}
