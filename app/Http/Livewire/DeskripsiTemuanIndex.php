<?php

namespace App\Http\Livewire;

use App\Models\DeskripsiTemuan;
use App\Models\FormAmiDokumen;
use App\Models\JawabanFormAmiDokumen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DeskripsiTemuanIndex extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = [
        'FixHapusDeskripsi' => 'hapusDeskripsi',
    ];

    public function render()
    {
        $form = JawabanFormAmiDokumen::with(['formAmiDokumen.timAuditors', 'formAmiDokumen.auditee', 'deskripsiTemuan']) //'jawabanable.amiDokumen'
            ->where(function ($q) {
                $q->where('deskripsi', 'like', '%' . $this->search . '%')
                    ->where('kts', 'kts');
            })
            ->whereHas('formAmiDokumen.timAuditors', function ($q) {
                $q->where('id_user_auditor', Auth::user()->id);
            });
        return view('livewire.deskripsi-temuan-index', [
            'isiTabel' => $form->paginate(30),
        ]);
    }

    public function hapusDeskripsi($id)
    {
        DeskripsiTemuan::find($id)->delete();
        return $this->emit('swalDeleted');
    }
}
