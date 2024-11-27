<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyusutanBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'dkasset',
        'tanggal_pembelian',
        'harga_awal',
        'harga_penyusutan_perhari',
        'harga_penyusutan',
    ];
    public function barang()
    {
        return $this->morphTo();
    }
}
