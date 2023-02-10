<?php

namespace App\Http\Livewire;

use App\Models\JawabanFormAmiDokumen;
use Livewire\Component;
use Livewire\WithPagination;

class JawabanAmidokumenDetail extends Component
{
    public $idFormAmi;
    public $jawabans;

    public function render()
    {
        return view('livewire.jawaban-amidokumen-detail');
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
}
