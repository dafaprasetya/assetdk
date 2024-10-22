<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerahTerimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serah_terimas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima');
            $table->string('divisi_penerima');
            $table->string('nama_pemberi');
            $table->string('divisi_pemberi');
            $table->char('dkasset');
            $table->foreign('dkasset')->references('dkasset')->on('barangs')->onDelete('cascade');
            $table->enum('kondisi', ['baik', 'rusak']);
            $table->string('deskripsi');
            $table->timestamp('waktu')->useCurrent();
            $table->string('bukti');
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
        Schema::dropIfExists('serah_terimas');
    }
}
