<?php

namespace App\Http\Livewire;

use App\Models\TemplateSurat;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TemplateSuratIndex extends Component
{
    public $search;

    protected $listeners = [
        'FixHapusTemplateSurat' => 'HapusTemplateSurat',
    ];

    public function render()
    {

        $isiTabel=TemplateSurat::where('title', 'like', '%'.$this->search.'%')
        ->orWhere('keterangan', 'like', '%'.$this->search.'%')
        ->orderBy('created_at', 'desc');


        return view('livewire.template-surat-index',[
            'isiTabel' => $isiTabel->paginate(30),
        ]);
    }

    public function HapusTemplateSurat($id)
    {
        $data=TemplateSurat::find($id);
        Storage::disk('__template_surat')->delete($data->getRawOriginal('file'));
        $data->delete();
        return $this->emit('swalDeleted');
    }
}
