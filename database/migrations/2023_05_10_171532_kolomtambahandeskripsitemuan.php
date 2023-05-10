<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kolomtambahandeskripsitemuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deskripsi_temuans', function (Blueprint $table) {
            $table->string('jadwal_perbaikan');
            $table->string('pj_perbaikan');
            $table->string('rencana_pencegahan');
            $table->string('pj_pencegahan');
            $table->string('jadwal_pencegahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deskripsi_temuans', function (Blueprint $table) {
            $table->dropColumn([
                'jadwal_perbaikan',
                'pj_perbaikan',
                'rencana_pencegahan',
                'pj_pencegahan',
                'jadwal_pencegahan',
            ]);
        });
    }
}
