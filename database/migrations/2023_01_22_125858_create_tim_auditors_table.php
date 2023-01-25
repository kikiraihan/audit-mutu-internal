<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimAuditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tim_auditors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_form_ami_dokumen')->references('id')->on('form_ami_dokumens')->cascadeOnDelete();
            $table->foreignId('id_user_auditor')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('status', ['anggota','ketua']);

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
        Schema::dropIfExists('tim_auditors');
    }
}
