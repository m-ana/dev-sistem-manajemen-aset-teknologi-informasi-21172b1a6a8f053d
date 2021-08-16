<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDataPerangkatKerasTable extends Migration
{
    public function up()
    {
        Schema::table('data_perangkat_keras', function (Blueprint $table) {
            $table->unsignedBigInteger('nomor_rak_id');
            $table->foreign('nomor_rak_id', 'nomor_rak_fk_4298365')->references('id')->on('raks');
            $table->unsignedBigInteger('nama_merk_id');
            $table->foreign('nama_merk_id', 'nama_merk_fk_4298366')->references('id')->on('merks');
            $table->unsignedBigInteger('nama_jenis_id')->nullable();
            $table->foreign('nama_jenis_id', 'nama_jenis_fk_4298367')->references('id')->on('jenis');
            $table->unsignedBigInteger('nama_status_id')->nullable();
            $table->foreign('nama_status_id', 'nama_status_fk_4298379')->references('id')->on('statuses');
            $table->unsignedBigInteger('nama_lokasi_id')->nullable();
            $table->foreign('nama_lokasi_id', 'nama_lokasi_fk_4298953')->references('id')->on('data_centers');
        });
    }
}
