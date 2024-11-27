<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jenisasset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangs', function ($table) {
            $table->string('jenis_asset')->nullable();
            $table->string('harga_awal')->nullable();
            $table->string('harga_penyusutan_perhari')->nullable();
            $table->string('harga_penyusutan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
