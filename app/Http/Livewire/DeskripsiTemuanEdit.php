<?php

namespace App\Http\Livewire;

use App\Models\DeskripsiTemuan;
use Livewire\Component;

class DeskripsiTemuanEdit extends Component
{
    public $idTo;
    public DeskripsiTemuan $data;


    public function mount($id)
    {
        $this->data = DeskripsiTemuan::find($id);
        $this->idTo = $id;
    }

    protected $rules = [
        "data.id_form_ami_dokumen" => 'required', //string
        "data.id_jawaban_form_ami_dokumens" => "required", //string
        "data.akar_penyebab" => "required", //string
        "data.akibat" => "required", //string
        "data.rekomendasi" => "required", //string
        "data.tanggapan_auditee" => "required", //string
        "data.rencana_perbaikan" => "required", //string
        "data.jadwal_perbaikan" => 'required',
        "data.pj_perbaikan" => 'required',
        "data.rencana_pencegahan" => 'required',
        "data.pj_pencegahan" => 'required',
        "data.jadwal_pencegahan" => 'required',
    ];


    public function save()
    {
        $this->validate();
        $this->data->save();

        $this->mount($this->idTo);
        $this->emit('swalUpdated');
    }

    public function render()
    {
        return view('livewire.deskripsi-temuan-edit');
    }
}
