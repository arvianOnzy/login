<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DokumenMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_master', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dok');
            $table->string('no_dok');
            $table->string('jenisdok_id');
            // $table->string('lokasi');
            $table->string('ruangan');
            $table->string('rak');
            $table->string('kardus');
            $table->string('gambar')->nullable();

            $table->timestamp('last_used_at')->nullable();
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
        Schema::dropIfExists('dokumen_master');
    }
}
