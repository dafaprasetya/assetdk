<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class assetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // Barang::truncate();
        $csvFile = fopen(base_path("database/data/databaru4.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                // $qr = QrCode::format('png')->generate($data[0]);
                // $qrImageName =  $data[0].'.png';
                // Storage::put('public/qrasset/', $qrImageName, $qr);
                DB::table('barangs')->insert([
                    "dkasset" => $data[0],
                    "nama_asset" => $data[1],
                    "merk" => $data[2],
                    "kategoriId" => $data[3],
                    "user" => $data[4],
                    "jabatanId" => $data[5],
                    "divisiId" => $data[6],
                    "area" => $data[7],
                    "lokasi" => $data[8],
                    "status_aktif" => $data[9],
                    "kondisi" => $data[10],
                    "QTY" => $data[11],
                    "foto" => $data[12],
                    "asset_validasi" => $data[13],
                    "tanggal" => $data[14],
                    "signature" => $data[15],
                    "foto_tanda_terima" => $data[16],
                    "keterangan_asset" => $data[17],
                    "status_label_kode" => $data[18],
                    "status" => $data[19],
                    // "qr" => $data[0].'.png',
                ]);    

            }

            $firstline = false;

        }
        fclose($csvFile);
    }
}
