<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaksTable extends Migration
{
    public function up()
    {
        Schema::create('raks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor')->unique();
            $table->timestamps();
        });
    }
}
