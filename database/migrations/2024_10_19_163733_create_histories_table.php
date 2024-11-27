<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->char('dkasset');
            $table->string('pemegang');
            $table->string('ttd_pemegang');
            $table->string('divisi_pemegang')->nullable();
            $table->string('kondisi');
            $table->string('deskripsi');
            $table->string('foto');
            $table->string('waktu');
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
        Schema::dropIfExists('histories');
    }
}
