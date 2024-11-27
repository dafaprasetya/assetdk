<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyusutanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyusutan_barangs', function (Blueprint $table) {
            $table->id();
            $table->char('dkasset');
            $table->string('harga_awal')->nullable();
            $table->string('harga_penyusutan_perhari')->nullable();
            $table->string('harga_penyusutan')->nullable();
            $table->date('tanggal_pembelian')->nullable();
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
        Schema::dropIfExists('penyusutan_barangs');
    }
}
