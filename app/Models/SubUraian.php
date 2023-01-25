<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUraian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_uraian',
        'nomor',
        'isi',
    ];

    public function uraian()
    {
        return $this->belongsTo(Uraian::class);
    }

    public function JawabanFormAmiDokumens()
    {
        // morph many
        return $this->morphMany(JawabanFormAmiDokumen::class, 'jawabanable');
    }

    // public function JawabanFormAmiDokumensByFormId($id)
    // {
    //     // morph many
    //     return $this->morphMany(JawabanFormAmiDokumen::class, 'jawabanable')
    //         ->where('id_form_ami_dokumen',$id);
    // }


}
