<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormAmiDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ami_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user_auditee')->references('id')->on('users');
            $table->foreignId('id_ami_dokumen')->references('id')->on('ami_dokumens');
            $table->string('ruang_lingkup')->nullable();
            $table->string('wakil_auditee');
            $table->enum('status', ['dalam pengisian', 'dalam validasi', 'selesai'])->default('dalam pengisian');

            //audit lapangan
            $table->string('lapangan_lokasi')->nullable();
            $table->date('lapangan_tanggal')->nullable();

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
        Schema::dropIfExists('form_ami_dokumens');
    }
}
