<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmiDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
    ];


    public function uraians()
    {
        return $this->hasMany(Uraian::class,'id_ami_dokumen','id');
    }
    
    //sub uraians has many through
    public function suburaians()
    {
        return $this->hasManyThrough(SubUraian::class, Uraian::class,'id_ami_dokumen','id_uraian','id');
    }
}
