<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    //formAmiDokumens hasManyThrough User
    public function formAmiDokumens()
    {
        return $this->hasManyThrough(FormAmiDokumen::class, User::class, 'id_user', 'id_user_auditee');
    }
}
