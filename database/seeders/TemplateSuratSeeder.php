<?php

namespace Database\Seeders;

use App\Models\TemplateSurat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TemplateSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TemplateSurat::insert([
            [
                'title'=>"Surat Pengantar Untuk Auditi",
                'file'=>"SURAT_PENGANTAR_UNTUK_AUDITI.docx",
                'created_at'=> Carbon::now(),
            ],
            [
                'title'=>"Surat Pengantar Untuk Auditor",
                'file'=>"SURAT_PENGANTAR_UNTUK_AUDITOR.docx",
                'created_at'=> Carbon::now(),
            ],
            [
                'title'=>"Surat Tugas Auditor",
                'file'=>"SURAT_TUGAS_AUDITOR.docx",
                'created_at'=> Carbon::now(),
            ],
        ]);
    }
}
