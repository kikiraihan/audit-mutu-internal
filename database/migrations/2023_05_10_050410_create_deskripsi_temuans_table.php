<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskripsiTemuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deskripsi_temuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jawaban_form_ami_dokumens')->references('id')->on('jawaban_form_ami_dokumens');
            $table->foreignId('id_form_ami_dokumen')->references('id')->on('form_ami_dokumens');
            $table->string('akar_penyebab');
            $table->string('akibat');
            $table->string('rekomendasi');
            $table->string('tanggapan_auditee');
            $table->string('rencana_perbaikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deskripsi_temuans');
    }
}
