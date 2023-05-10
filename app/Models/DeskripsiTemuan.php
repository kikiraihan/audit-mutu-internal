<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskripsiTemuan extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        "id_form_ami_dokumen",
        "id_jawaban_form_ami_dokumens",
        "akar_penyebab",
        "akibat",
        "rekomendasi",
        "tanggapan_auditee",
        "rencana_perbaikan",
        "jadwal_perbaikan",
        "pj_perbaikan",
        "rencana_pencegahan",
        "pj_pencegahan",
        "jadwal_pencegahan",
    ];

    public function jawabanFormAmiDokumen()
    {
        return $this->belongsTo(JawabanFormAmiDokumen::class, 'id_jawaban_form_ami_dokumens');
    }

    public function formAmiDokumen()
    {
        return $this->belongsTo(FormAmiDokumen::class, 'id_form_ami_dokumen');
    }
}
