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
        "kategoriId",
        "user",
        "jabatanId",
        "divisiId",
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
        "keterangan_asset",
        "status_label_kode",
        "status"
    ];
    protected $primaryKey = 'dkasset';
    public $incrementing = false;
    protected $keyType = 'string';

    // public function history(){
    //     return $this->hasMany(History::class);
    // }
    // public function serahterima(){
    //     return $this->hasMany(SerahTerima::class);
    // }
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategoriId');
    }
    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'jabatanId');
    }
    public function divisi() {
        return $this->belongsTo(Divisi::class, 'divisiId');
    }
}
