<?php

namespace App\Http\Livewire;

use App\Models\TimAuditor;
use App\Models\User;
use Livewire\Component;

class FormAmidokumenTimauditor extends Component
{
    public $idTo;
    public TimAuditor $au;

    public $search;
    protected $listeners=[
        'FixHapusAuditorAmi'=>'hapusAuditorAmi',
    ];

    protected $rules = [
        'au.id_form_ami_dokumen' => 'required',
        'au.id_user_auditor' => 'required',
        'au.status' => 'required',
    ];

    public function mount($id)
    {
        $this->au = new TimAuditor;
        $this->au->id_form_ami_dokumen = $id;
        $this->idTo = $id;
    }


    public function render()
    {
        //tabel
        $isi = TimAuditor::with(['user'])->where('id_form_ami_dokumen', $this->idTo)->orderBy('status', 'desc')->orderBy('created_at', 'desc');
        
        //select
        $auditor = User::whereHas('roles', function($q){
            $q->where('name', 'Auditor');
        })
        ->where('name', 'like', '%' . $this->search . '%')
        ->orderBy('created_at', 'desc');

        return view('livewire.form-amidokumen-timauditor',[
            'isiTabel'=>$isi->get(),
            'select' => $auditor->paginate(5),
            'dipilih'=> $this->au->id_user_auditor?User::find($this->au->id_user_auditor):null,
        ]);
    }

    public function save()
    {
        $this->validate();
        $this->au->save();

        $this->mount($this->idTo);
        $this->emit('swalAdded');
    }

    public function pilih($id)
    {
        $this->au->id_user_auditor = $id;
    }

    public function hapusAuditorAmi($id)
    {
        TimAuditor::find($id)->delete();
        return $this->emit('swalDeleted');
    }
}
