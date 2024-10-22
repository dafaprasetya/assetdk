<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    use HasFactory;

    protected $fillable = [
        "dkasset",
        "nama_asset",
        "merk",
        "kategori",
        "user",
        "jabatan",
        "divisi",
        "area",
        "lokasi",
        "status_aktif",
        "kondisi",
        "QTY",
        "foto",
        "asset_validasi",
        "tanggal",
        "signature",
        "foto_tanda_terima",
        "keterangan_aset",
        "status_label_kode",
        "status"
    ];

    public function history(){
        return $this->hasMany(History::class);
    }
    public function serahterima(){
        return $this->hasMany(SerahTerima::class);
    }
    // public function kategori() {
    //     return $this->belongsTo(Kategori::class);
    // }
}
