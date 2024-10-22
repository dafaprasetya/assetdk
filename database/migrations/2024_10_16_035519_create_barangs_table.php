<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->char('dkasset')->primary();
            $table->string('nama_asset');
            $table->string('merk')->nullable();
            $table->string('kategori')->nullable();
            $table->string('user')->nullable()->default('Team asset');
            $table->string('jabatan')->nullable()->default('staff');
            $table->string('divisi')->nullable()->default('Asset');
            $table->string('area')->nullable()->default('Asset');
            $table->string('lokasi')->nullable()->default('Taman Sari Persada');
            $table->string('status_aktif')->nullable();
            $table->string('kondisi')->nullable();
            $table->integer('QTY')->nullable();
            $table->string('foto')->nullable();
            $table->string('asset_validasi')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('signature')->nullable();
            $table->string('foto_tanda_terima')->nullable();
            $table->string('keterangan_asset')->nullable();
            $table->string('status_label_kode')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('barangs');
    }
}
