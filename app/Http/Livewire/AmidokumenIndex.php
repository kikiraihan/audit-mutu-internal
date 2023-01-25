<?php

namespace App\Http\Livewire;

use App\Models\AmiDokumen;
use Livewire\Component;
use Livewire\WithPagination;

class AmidokumenIndex extends Component
{
    use WithPagination;

    public $search;

    // 'date',//date
    // 'title',//string
    // 'photo',//file
    // 'body',// text area
    // 'view',//integer

    protected $listeners=[
        'FixHapusAmidokumen'=>'hapusAmidokumen',
    ];

    public function render()
    {
        $ami=AmiDokumen::where('judul', 'like', '%'.$this->search.'%')->orderBy('created_at', 'desc');

        return view('livewire.amidokumen-index', [
            'isiTabel' => $ami->paginate(30),
        ]);
    }

    public function hapusAmidokumen($id)
    {
        $n=AmiDokumen::find($id);
        $n->delete();
        return $this->emit('swalDeleted');
    }
}
