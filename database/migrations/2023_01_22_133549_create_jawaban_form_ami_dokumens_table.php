<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanFormAmiDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_form_ami_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_form_ami_dokumen')->references('id')->on('form_ami_dokumens')->cascadeOnDelete();
            //foreignid id_uraian/id_suburaian
            $table->integer('jawabanable_id');
            $table->string('jawabanable_type');
            
            $table->enum('jawaban',['belum',1,0])->default('belum');
            $table->text('catatan')->nullable();
            
            // audit lapangan
            $table->enum('kts',['belum','ob','kts'])->default('belum');
            $table->text('deskripsi')->nullable();

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
        Schema::dropIfExists('jawaban_form_ami_dokumens');
    }
}
