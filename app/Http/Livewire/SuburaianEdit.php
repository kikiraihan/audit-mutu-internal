<?php

namespace App\Http\Livewire;

use App\Models\AmiDokumen;
use App\Models\SubUraian;
use App\Models\Uraian;
use Livewire\Component;

class SuburaianEdit extends Component
{
    public $idTo;
    public Uraian $ur;

    protected $rules = [
        // 'ur.isi' => 'required',//string
        'ur.suburaians.*.nomor' => 'required',
        'ur.suburaians.*.isi' => 'required',
    ];


    public function mount($id)
    {
        $this->ur=Uraian::find($id);
        $this->idTo = $id;
    }

    public function save()
    {
        $this->validate();

        $this->ur->suburaians->each->save();
        $this->ur->save();

        $this->mount($this->idTo);
        $this->emit('swalUpdated');
    }

    public function render()
    {
        return view('livewire.suburaian-edit');
    }

    public function newSubUraian()
    {
        if($this->ur->suburaians) $nomor=$this->ur->suburaians->count()+1;
        else $nomor=1;

        $sub = new SubUraian;
        $sub->id_uraian = $this->ur->id;
        $sub->nomor = '';#$nomor;
        $sub->isi = '';
        $sub->save();

        $this->mount($this->idTo);
        $this->emit('swalAdded');
    }

    public function hapusSubUraians($id)
    {
        $sub = SubUraian::find($id);
        $sub->delete();
        $this->mount($this->idTo);
        return $this->emit('swalDeleted');
    }
}
