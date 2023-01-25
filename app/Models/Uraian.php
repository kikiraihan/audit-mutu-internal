<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uraian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ami_dokumen',
        'nomor',
        'isi',
    ];

    public function amiDokumen()
    {
        return $this->belongsTo(AmiDokumen::class,'id_ami_dokumen','id');
    }

    public function suburaians()
    {
        return $this->hasMany(SubUraian::class,'id_uraian','id');
    }

    public function JawabanFormAmiDokumens()
    {
        // morph many
        return $this->morphMany(JawabanFormAmiDokumen::class, 'jawabanable');
    }
}
