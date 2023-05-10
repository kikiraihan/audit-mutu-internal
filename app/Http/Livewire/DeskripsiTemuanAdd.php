<?php

namespace App\Http\Livewire;

use App\Models\DeskripsiTemuan;
use App\Models\JawabanFormAmiDokumen;
use Livewire\Component;

class DeskripsiTemuanAdd extends Component
{
    public DeskripsiTemuan $data;

    public function mount($id)
    {
        $this->data = new DeskripsiTemuan();
        $j = JawabanFormAmiDokumen::with(['formAmiDokumen'])->where('id', $id)->first();
        $this->data->id_form_ami_dokumen = $j->formAmiDokumen->id;
        $this->data->id_jawaban_form_ami_dokumens = $id;
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
        // dd($this->data);
        $this->validate();
        $this->data->save();

        $this->mount($this->data->id_jawaban_form_ami_dokumens);
        $this->emit('swalAdded');
    }

    public function render()
    {
        return view('livewire.deskripsi-temuan-add');
    }
}
