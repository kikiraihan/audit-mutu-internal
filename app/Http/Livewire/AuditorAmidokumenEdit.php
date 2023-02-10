<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class AuditorAmidokumenEdit extends Component
{
    // use WithPagination;
    public $idFormAmi;
    public $jawabans;
    // public FormAmiDokumen $form;

    public function render()
    {
        return view('livewire.auditor-amidokumen-edit');
    }
}
