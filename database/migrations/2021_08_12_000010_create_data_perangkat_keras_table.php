<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPerangkatKerasTable extends Migration
{
    public function up()
    {
        Schema::create('data_perangkat_keras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipe')->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('tahun_beli')->nullable();
            $table->string('nomor_u')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('ip')->nullable();
            $table->date('tahun_berakhir_garansi')->nullable();
            $table->string('nomor_u_kosong')->nullable();
            $table->string('kontak_pic')->nullable();
            $table->string('ruang_panel')->nullable();
            $table->timestamps();
        });
    }
}
