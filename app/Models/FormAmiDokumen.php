<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAmiDokumen extends Model
{
    use HasFactory;

    protected $appends = ['jawaban_kts_count','jawaban_ob_count','jawaban_belum_count'];


    protected $fillable = [
        'id_user_auditee',
        'id_ami_dokumen',
        'ruang_lingkup',
        'wakil_auditee',
        'di_review_oleh',
        'status',

        // diisi auditor di audit lapangan
        'lapangan_lokasi',
        'lapangan_tanggal',
    ];

    public function auditee()
    {
        return $this->belongsTo(User::class, 'id_user_auditee');
    }

    public function amiDokumen()
    {
        return $this->belongsTo(AmiDokumen::class, 'id_ami_dokumen');
    }

    public function jawabanFormAmiDokumens()
    {
        return $this->hasMany(JawabanFormAmiDokumen::class, 'id_form_ami_dokumen');
    }

    public function getJawabanKtsCountAttribute()
    {
        return $this->jawabanFormAmiDokumens()->where('kts', 'kts')->count();
    }

    public function getJawabanObCountAttribute()
    {
        return $this->jawabanFormAmiDokumens()->where('kts', 'ob')->count();
    }

    public function getJawabanBelumCountAttribute()
    {
        return $this->jawabanFormAmiDokumens()->where('kts', 'belum')->count();
    }

    public function timAuditors()
    {
        return $this->belongsToMany(User::class, 'tim_auditors', 'id_form_ami_dokumen', 'id_user_auditor')->withPivot('status');
    }

    public function deskripsiTemuan()
    {
        return $this->hasMany(DeskripsiTemuan::class, 'id_form_ami_dokumen');
    }

    // public function jawabanFormAmiDokumensUraian()
    // {
    //     return $this->hasMany(JawabanFormAmiDokumen::class, 'id_form_ami_dokumen')->where('jawabanable_type', 'App\Models\Uraian');
    // }

    // public function jawabanFormAmiDokumensSubUraian()
    // {
    //     return $this->hasMany(JawabanFormAmiDokumen::class, 'id_form_ami_dokumen')->where('jawabanable_type', 'App\Models\SubUraian');
    // }
}