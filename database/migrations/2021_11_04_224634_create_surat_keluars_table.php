<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->enum('bidang', ['Tata Usaha', 'Pembinaan', 'Intellijen', 'Tindak Pidana Umum', 'Tindak Pidana Khusus', 'Perdata dan TUN', 'Pengawasan']);
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_keluar');
            $table->date('tanggal_surat');
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
        Schema::dropIfExists('surat_keluars');
    }
}
