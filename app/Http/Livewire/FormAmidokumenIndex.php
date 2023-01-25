<?php

namespace App\Http\Livewire;

use App\Models\FormAmiDokumen;
use Livewire\Component;
use Livewire\WithPagination;

class FormAmidokumenIndex extends Component
{
    use WithPagination;

    public $search;

    protected $listeners=[
        'FixHapusFormAmidokumen'=>'hapusFormAmidokumen',
    ];

    public function render()
    {
        //get form ami dokumenwhereHas user name like
        $ami=FormAmiDokumen::with(['auditee','amiDokumen','timAuditors'])->whereHas('auditee', function($q){
            $q->where('name', 'like', '%'.$this->search.'%');
        })->orWhereHas('amiDokumen', function($q){
            $q->where('judul', 'like', '%'.$this->search.'%');
        })->orderBy('created_at', 'desc');

        // dd($ami->first());
        

        return view('livewire.form-amidokumen-index', [
            'isiTabel' => $ami->paginate(30),
        ]);
    }

    public function hapusFormAmidokumen($id)
    {
        FormAmiDokumen::find($id)->delete();
        return $this->emit('swalDeleted');
    }
}
