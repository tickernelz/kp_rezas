<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nomor_urut')->unique();
            $table->string('nomor_surat')->unique();
            $table->dateTime('tanggal_masuk');
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->string('kepada');
            $table->longText('perihal');
            $table->string('file')->nullable();
            $table->string('operator');
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
        Schema::dropIfExists('surat_masuks');
    }
}
