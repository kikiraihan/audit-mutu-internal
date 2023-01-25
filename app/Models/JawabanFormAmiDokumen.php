<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanFormAmiDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_form_ami_dokumen',
        'jawabanable_id',
        'jawabanable_type',
        'jawaban',
        'catatan',

        // diisi auditor di audit lapangan
        'kts',
        'deskripsi',
    ];

    public function jawabanable()
    {
        return $this->morphTo();
    }

    public function formAmiDokumen()
    {
        return $this->belongsTo(FormAmiDokumen::class, 'id_form_ami_dokumen');
    }
}
