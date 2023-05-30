<?php

namespace App\Http\Livewire;

use App\Models\TemplateSurat;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TemplateSuratEdit extends Component
{
    use WithFileUploads;
    
    public $file;
    public $idTo;
    public TemplateSurat $data;


    public function mount($id)
    {
        $this->data = TemplateSurat::find($id);
        $this->idTo = $id;
    }

    public function rules()
    {
        return [
            'data.title'=>'required',
            'file'=>'nullable|mimes:doc,docx',
            'data.keterangan'=>'nullable|string|max:255',
            // 'data.kode_unik'=>'required|regex:/^[^\s]+$/|unique:template_surats,kode_unik,'.$this->idTo.',',
        ];
    }
    public function messages() {
        return [
            'required'=>'Kolom :attribute tidak boleh kosong',
            'mimes' => 'Kolom :attribute, harus memiliki format dokumen .doc atau .docx',
            'unique'=>'Data kolom :attribute sudah ada sebelumnya',
            'regex'=>'kolom :attribute tidak boleh menggunakan spasi. Gunakan _ atau -',
        ];
    }
        

    public function save()
    {
        $this->validate();
        if ($this->file) {
            //delete lama
            Storage::disk('__template_surat')->delete($this->data->getRawOriginal('file'));
            // format nama file
            $originalFileName = $this->file->getClientOriginalName();
            $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
            $fileName = str_replace(' ', '_', $fileName);
            $fileName = $fileName.'_'.date('Ymd_His'); //format: YYYYMMDDHHIISS
            $fileName = $fileName.'.'.$this->file->getClientOriginalExtension();
            // simpan baru
            $this->data->file = $this->file->storeAs('',$fileName,'__template_surat');
        }
        $this->data->save();

        $this->mount($this->idTo);
        $this->emit('swalUpdated');
    }

    public function hapusFileLama()
    {
        Storage::disk('__template_surat')->delete($this->data->getRawOriginal('file'));
        $this->data->file=null;
        $this->data->save();
    }

    public function render()
    {
        return view('livewire.template-surat-edit');
    }    
}
