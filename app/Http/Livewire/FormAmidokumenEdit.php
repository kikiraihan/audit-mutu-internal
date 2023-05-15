<?php

namespace App\Http\Livewire;

use App\Models\AmiDokumen;
use App\Models\FormAmiDokumen;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class FormAmidokumenEdit extends Component
{

    use WithPagination;
    public FormAmiDokumen $form;
    public $searchAuditee;
    public $searchAmi;

    public $idTo;

    public function mount($id)
    {
        $this->form = FormAmiDokumen::find($id);
        $this->idTo = $id;
    }

    protected $rules = [
        'form.id_user_auditee'  => 'required',
        'form.id_ami_dokumen'   => 'required',
        'form.ruang_lingkup'    => 'nullable',
        'form.wakil_auditee'    => 'required',
        'form.status'           => 'required',
        // 'form.lapangan_lokasi'           => 'required',
        // 'form.lapangan_tanggal'          => 'required',
    ];

    public function save()
    {
        $this->validate();
        $this->form->save();

        $this->mount($this->idTo);
        $this->emit('swalUpdated');
    }


    public function render()
    {

        $auditee = User::has('auditee')
            ->where('name', 'like', '%' . $this->searchAuditee . '%')
            ->orderBy('created_at', 'desc');
        $ami = AmiDokumen::where('judul', 'like', '%' . $this->searchAmi . '%')
            ->orderBy('created_at', 'desc');

        return view('livewire.form-amidokumen-edit', [
            'selectAuditee' => $auditee->paginate(5),
            'dipilihAuditee' => $this->form->id_user_auditee ? User::find($this->form->id_user_auditee) : null,
            'selectAmi' => $ami->paginate(5),
            'dipilihAmi' => $this->form->id_ami_dokumen ? AmiDokumen::find($this->form->id_ami_dokumen) : null,
        ]);
    }

    public function pilihAuditee($id)
    {
        $this->form->id_user_auditee = $id;
    }

    public function pilihAmi($id)
    {
        $this->form->id_ami_dokumen = $id;
    }

    public function batalAuditee()
    {
        $this->form->id_user_auditee = '';
    }

    public function batalAmi()
    {
        $this->form->id_ami_dokumen = '';
    }
}
