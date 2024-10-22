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
            $table->foreign('dkasset')->references('dkasset')->on('barangs')->onDelete('cascade');
            $table->integer('nik_pemilik');
            $table->integer('nama_pemilik');
            $table->integer('divisi_pemilik');
            $table->enum('kondisi', ['baik', 'rusak']);
            $table->string('deskripsi');
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
