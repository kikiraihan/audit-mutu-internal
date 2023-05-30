<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_surats', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('file',255)->nullable();
            $table->string('keterangan')->nullable();//posisi di aplikasi dimana
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
        Schema::dropIfExists('template_surats');
    }
}
