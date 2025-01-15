<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarcodeAPI extends Controller
{
    public function getBarcode($dkasset) {
        $barcode = QrCode::size(90)->generate('assetku.dkriuk.com/aset/'.$dkasset);
        $barcodeBase64 = base64_encode($barcode);
        return response()->json([
            'barcode' => 'data:image/svg+xml;base64,'.$barcodeBase64,
        ]);
    }
}
