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
            $table->char('dkasset');
            $table->foreign('dkasset')->references('dkasset')->on('barangs')->onDelete('cascade');
            $table->string('nama_penerima');
            $table->string('divisi_penerima')->nullable();
            $table->string('jabatan_penerima')->nullable();
            $table->string('ttd_penerima');
            $table->string('nama_penyerah');
            $table->string('divisi_penyerah')->nullable();
            $table->string('jabatan_penyerah')->nullable();
            $table->string('ttd_penyerah');
            $table->string('kondisi');
            $table->string('foto');
            $table->string('tempat');
            $table->string('deskripsi');
            $table->string('bukti')->nullable();
            $table->timestamp('waktu')->useCurrent();
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
