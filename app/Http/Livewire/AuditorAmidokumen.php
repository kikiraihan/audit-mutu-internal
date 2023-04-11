<?php

namespace App\Http\Livewire;

use App\Models\FormAmiDokumen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AuditorAmidokumen extends Component
{
    use WithPagination;
    public $search;

    protected $listeners=[
        'FixSelesaiAuditorAmiDokumen'=>'SelesaiAuditorAmiDokumen',
        'FixBatalSelesaiAuditorAmiDokumen'=>'BatalSelesaiAuditorAmiDokumen',
    ];


    public function render()
    {
        //get form ami dokumenwhereHas user name like
        $ami=FormAmiDokumen::with(['amiDokumen','timAuditors','auditee'])
        ->whereHas('timAuditors', function($q){
            $q->where('id_user_auditor', Auth::user()->id);
        })
        ->whereHas('amiDokumen', function($q){
            $q->where('judul', 'like', '%'.$this->search.'%')
            ->orWhere('status', 'like', '%'.$this->search.'%');
        })->orderBy('created_at', 'desc');

        return view('livewire.auditor-amidokumen',[
            'isiTabel' => $ami->paginate(30),
        ]);
    }

    public function SelesaiAuditorAmiDokumen($id)
    {
        FormAmiDokumen::find($id)->update([
            'status'=>'selesai',
        ]);
    }

    public function BatalSelesaiAuditorAmiDokumen($id)
    {
        FormAmiDokumen::find($id)->update([
            'status'=>'dalam validasi',
        ]);
    }
}
