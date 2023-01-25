<?php

namespace App\Http\Livewire;

use App\Models\FormAmiDokumen;
use App\Models\JawabanFormAmiDokumen;
use App\Models\Uraian;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isEmpty;

class JawabanAmidokumenEdit extends Component
{
    use WithPagination;
    public $idFormAmi;
    public $jawabans;
    // public FormAmiDokumen $form;

    //rule
    protected $rules = [
        'jawabans.*.id_form_ami_dokumen'    => 'required',
        'jawabans.*.jawabanable_id'         => 'required',
        'jawabans.*.jawabanable_type'       => 'required',
        'jawabans.*.jawaban'                => 'nullable',
        'jawabans.*.catatan'                => 'nullable',
    ];

    public function mount($id)
    {

        // $this->form=FormAmiDokumen::with(['amiDokumen.uraians.suburaians'])->where('id',$id)->first();
        $this->idFormAmi=$id;
        $this->jawabans=JawabanFormAmiDokumen::with(['jawabanable','formAmiDokumen'])
            ->where('id_form_ami_dokumen',$this->idFormAmi)
            ->orderBy('jawabanable_type','asc')
            ->orderBy('jawabanable_id','asc')
            ->get();

        // dd($this->jawabans);
    }

    public function render()
    {
        return view('livewire.jawaban-amidokumen-edit');
    }


    public function save()
    {
        $this->validate();

        $this->jawabans->each->save();

        $this->mount($this->idFormAmi);
        $this->emit('swalUpdated');
    }

    public function refreshJawaban()
    {
        $form=FormAmiDokumen::with(['amiDokumen.uraians.suburaians'])
            ->where('id',$this->idFormAmi)->first();

        foreach ($form->amiDokumen->uraians as $ur) 
        {
            if ($ur->suburaians->isEmpty()) 
                $this->createJawabanKosong('App\Models\Uraian',$ur->id);
            else
            {
                foreach ($ur->suburaians as $sub) 
                    $this->createJawabanKosong('App\Models\SubUraian',$sub->id);
            }
        }

        $this->mount($this->idFormAmi);
        $this->emit('swalAdded');
    }

    public function createJawabanKosong($jawabanable_type,$jawabanable_id)
    {
        $cek=JawabanFormAmiDokumen::where('id_form_ami_dokumen',$this->idFormAmi)
        ->where('jawabanable_type',$jawabanable_type)
        ->where('jawabanable_id',$jawabanable_id)
        ->first();

        if ($cek) {
            return null;
        }

        $j = new JawabanFormAmiDokumen;
        $j->id_form_ami_dokumen = $this->idFormAmi;
        $j->jawabanable_type = $jawabanable_type;
        $j->jawabanable_id = $jawabanable_id;
        $j->save();
    }


}
