<?php

namespace App\Http\Livewire;

use App\Models\JawabanFormAmiDokumen;
use Livewire\Component;
use Livewire\WithPagination;

class AuditorAmidokumenEdit extends Component
{
    // use WithPagination;
    public $idFormAmi;
    public $jawabans;
    // public FormAmiDokumen $form;

    //rule
    protected $rules = [
        'jawabans.*.id_form_ami_dokumen'    => 'required',
        'jawabans.*.jawabanable_id'         => 'required',
        'jawabans.*.jawabanable_type'       => 'required',
        'jawabans.*.kts'                => 'nullable',
        'jawabans.*.deskripsi'                => 'nullable',
    ];

    public function render()
    {
        return view('livewire.auditor-amidokumen-edit');
    }

    public function mount($id)
    {

        // $this->form=FormAmiDokumen::with(['amiDokumen.uraians.suburaians'])->where('id',$id)->first();
        $this->idFormAmi=$id;
        $this->jawabans=JawabanFormAmiDokumen::with(['jawabanable','formAmiDokumen'])
            ->where('id_form_ami_dokumen',$this->idFormAmi)
            // ->orderBy('jawabanable_type','asc')
            // ->orderBy('jawabanable_id','asc')
            ->get();

        // dd($this->jawabans);
    }

    public function save()
    {
        $this->validate();

        $this->jawabans->each->save();

        $this->mount($this->idFormAmi);
        $this->emit('swalUpdated');
    }
}
