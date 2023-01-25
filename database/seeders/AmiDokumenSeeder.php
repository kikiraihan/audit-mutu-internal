<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AmiDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // amidokumen create
        $amidokumen = \App\Models\AmiDokumen::create([
            'judul' => 'VISI, MISI, TUJUAN & SASARAN',
        ]);

        $uraian = \App\Models\Uraian::create([
            'id_ami_dokumen' => $amidokumen->id,
            'nomor' => '1',
            'isi' => 'Tersedianya dokumen VMTS Fakultas/Pascasarjana/prodi yang sangat jelas, sangat realistis dan memiliki pengesahan yang dilengkapi dengan:',
        ]);
        \App\Models\SubUraian::create([
            'id_uraian' => $uraian->id,
            'nomor' => 'a',
            'isi' => 'Dokumen Panduan penyusunan VMTS',
        ]);
        \App\Models\SubUraian::create([
            'id_uraian' => $uraian->id,
            'nomor' => 'b',
            'isi' => 'Dokumen bukti pelaksanaan analisis SWOT untuk penyusunan VMTS Fakultas/Pascasarjana/prodi',
        ]);
        \App\Models\SubUraian::create([
            'id_uraian' => $uraian->id,
            'nomor' => 'c',
            'isi' => 'Dokumen bukti penyusunan VMTS yang melibatkan pemangku kepentingan internal (pimpinan, dosen, tenaga kependidikan, dan mahasiswa) dan eksternal (pengguna lulusan, mitra, organisasi profesi, organisasi keilmuan, pemerintah, alumni dan pakar)',
        ]);
        \App\Models\SubUraian::create([
            'id_uraian' => $uraian->id,
            'nomor' => 'd',
            'isi' => 'Dokumen VMTS Fak/Pasca memiliki keselarasan dengan VMTS UNG',
        ]);
        \App\Models\SubUraian::create([
            'id_uraian' => $uraian->id,
            'nomor' => 'e',
            'isi' => 'Tersedianya visi keilmuan pada masing-masing prodi',
        ]);
        $uraian = \App\Models\Uraian::create([
            'id_ami_dokumen' => $amidokumen->id,
            'nomor' => '2',
            'isi' => 'Tersedianya dokumen Pedoman penyusunan RIP, RENSTRA dan RENOP Fakultas/Pasca/prodi',
        ]);
        $uraian = \App\Models\Uraian::create([
            'id_ami_dokumen' => $amidokumen->id,
            'nomor' => '3',
            'isi' => 'Tersedianya dokumen RIP, RENSTRA dan RENOP Fakultas/Pasca/prodi dan tonggak-tonggak capaian (milestone) yang dievaluasi secara berkala',
        ]);

        $uraian = \App\Models\Uraian::create([
            'id_ami_dokumen' => $amidokumen->id,
            'nomor' => '4',
            'isi' => 'Tersedianya dokumen bukti pelaksanaan sosialisasi VMTS',
        ]);

        $uraian = \App\Models\Uraian::create([
            'id_ami_dokumen' => $amidokumen->id,
            'nomor' => '5',
            'isi' => 'Tersedianya dokumen bukti pelaksanaan monev pemahaman VMTS di tingkat Fakultas/Pasca/prodi',
        ]);

    }
}
