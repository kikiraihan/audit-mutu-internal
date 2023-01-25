<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimAuditor extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'id_form_ami_dokumen',
        'id_user_auditor',
        'status',
    ];

    //relasi
    public function formAmiDokumen()
    {
        return $this->belongsTo(FormAmiDokumen::class, 'id_form_ami_dokumen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_auditor');
    }
}
