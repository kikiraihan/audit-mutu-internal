<?php

namespace App\Http\Livewire;

use App\Models\AmiDokumen;
use App\Models\SubUraian;
use App\Models\Uraian;
use Livewire\Component;

class AmidokumenEdit extends Component
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

    public function save()
    {
        $this->validate();

        if ($this->ami->uraians) $this->ami->uraians->each->save();
        $this->ami->save();

        $this->mount($this->idTo);
        $this->emit('swalUpdated');
    }


    public function render()
    {
        return view('livewire.amidokumen-edit');
    }


    public function newUraian()
    {
        if($this->ami->uraians) $nomor=$this->ami->uraians->count()+1;
        else $nomor=1;

        $uraian = new Uraian;
        $uraian->id_ami_dokumen = $this->ami->id;
        $uraian->nomor = '';#$nomor;
        $uraian->isi = '';
        $uraian->save();

        $this->mount($this->idTo);
        $this->emit('swalAdded');
    }

    public function hapusUraian($id)
    {
        $uraian = Uraian::find($id);
        $uraian->delete();
        $this->mount($this->idTo);
        return $this->emit('swalDeleted');
    }

    public function newSubUraian($idUraian)
    {
        $uraian=Uraian::find($idUraian);
        if($uraian->suburaians) $nomor=$uraian->suburaians->count()+1;
        else $nomor=1;

        $sub = new SubUraian;
        $sub->id_uraian = $idUraian;
        $sub->nomor = $nomor;
        $sub->isi = 'coba';
        $sub->save();

        $this->mount($this->idTo);
        $this->emit('swalAdded');
    }
}
