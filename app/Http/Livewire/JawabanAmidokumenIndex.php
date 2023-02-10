<?php

namespace App\Http\Livewire;

use App\Models\FormAmiDokumen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class JawabanAmidokumenIndex extends Component
{
    use WithPagination;
    public $search;

    protected $listeners=[
        'FixSelesaiJawabanAmiDokumen'=>'SelesaiJawabanAmiDokumen',
        'FixBatalSelesaiJawabanAmiDokumen'=>'BatalSelesaiJawabanAmiDokumen',
    ];

    public function render()
    {
        //get form ami dokumenwhereHas user name like
        $ami=FormAmiDokumen::with(['amiDokumen','timAuditors'])
        ->where('id_user_auditee',Auth::user()->id)
        ->whereHas('amiDokumen', function($q){
            $q->where('judul', 'like', '%'.$this->search.'%')
            ->orWhere('status', 'like', '%'.$this->search.'%');
        })->orderBy('created_at', 'desc');

        return view('livewire.jawaban-amidokumen-index', [
            'isiTabel' => $ami->paginate(30),
        ]);
    }

    public function SelesaiJawabanAmiDokumen($id)
    {
        FormAmiDokumen::find($id)->update([
            'status'=>'dalam validasi',
        ]);
    }

    public function BatalSelesaiJawabanAmiDokumen($id)
    {
        FormAmiDokumen::find($id)->update([
            'status'=>'dalam pengisian',
        ]);
    }


}
