<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class JDKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            'IT - Elektronik',
            'Furniture',
            'Perlengkapan Kantor',
            'Peralatan Kantor',
            'Infrastuktur - Elektronik',
            'Alat Kantor - Elektronik',
            'Alat Teknisi',
            'alat Vakum+Sealer+Plastik Vakum'
        ];

        // Looping array dan insert setiap nilai ke database
        foreach ($kategoris as $kategori) {
            DB::table('kategoris')->insert([
                'nama' => $kategori,
            ]);
        }
        $jabatans = [
            'Staff',
            'Direktur Utama',
            'Ass. Dir. Utama',
            'Direktur Operasional',
            'Ass. Dir. Operasional',
            'Direktur Finance',
            'Ass. Dir. Finance',
            'Head Unit',
            'Senior Manager',
            'Manager',
            'Supervisor',
            'PIC',
            'Security',
            'Teknisi'
        ];

        // Looping array dan insert setiap nilai ke database
        foreach ($jabatans as $jabatan) {
            DB::table('jabatans')->insert([
                'nama' => $jabatan,
            ]);
        }
        $divisis = [
            'Humas & Service',
            'Operasional',
            'Manufaktur',
            'Ekspedisi',
            'Produksi',
            'HRD',
            'Planner',
            'Marketing',
            'Business Development',
            'Partnership & Support',
            'Finance',
            'Logistik',
            'stokis',
            'Direktur',
            'Head Unit',
            'Asset',
            'Admin',
            'Kemitraan'
        ];

        // Looping array dan insert setiap nilai ke database
        foreach ($divisis as $divisi) {
            DB::table('divisis')->insert([
                'nama' => $divisi,
            ]);
        }
        DB::table('users')->insert([
            'nik' => '20220457',
            'nama' => 'Muhamad Dafa Prasetya',
            'divisi' => 'IT',
            'email' => 'dafaprstya150@email.com',
            'password' => bcrypt('dafaprstya'),
        ]);
    }
}
