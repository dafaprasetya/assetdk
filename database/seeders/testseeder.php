<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class testseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert([
            "dkasset" => "hai123",
            "nama_asset" => "hai",
            "status" => QrCode::size(80)->generate(route('detailasset',"hai123")),
            // "qr" => $data[0].'.png',
        ]);   
         
    }
}
