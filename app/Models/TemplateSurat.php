<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'file',
        'keterangan',
        'created_at'
    ];

    public function getFileAttribute($value){
        if($value!=NULL){
            return Storage::disk('__template_surat')->url($value);
        }else
        return null;
    }

    public function getFileIfNullReturnTemplateAttribute(){
        if($this->file!=NULL){
            return $this->file;
        }else
        // return 'https://source.unsplash.com/random/1920x1080'; 
        return asset('/gambar/image-kosong(1080x1080).jpg');
    }

    // public function getFilePathAttribute($value)
    // {
    //     return asset('storage/'.$value);
    // }
}
