<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Barangdkl;
use App\Models\Divisi;
use App\Models\Kategori;
use App\Models\History;
use App\Models\PenyusutanBarang;

class AssetAPI extends Controller
{
    public function getKondisi() {
        $listbarang = Barang::all();
        $totalasset = $listbarang->count();
        $totalassetbaik = Barang::where('kondisi', 'Baik')->count();
        $totalassetrusak = Barang::where('kondisi', 'Rusak')->count();
        $totalassetperbaikan = Barang::where('kondisi', 'Maintenance')->count();
        
        return response()->json([
            'totalasset' => $totalasset,
            'totalassetbaik' => $totalassetbaik,
            'totalassetrusak' => $totalassetrusak,
            'totalassetperbaikan' => $totalassetperbaikan,
        ]);
    }
    public function getKondisiDkl() {
        $listbarang = Barangdkl::all();
        $totalasset = $listbarang->count();
        $totalassetbaik = Barangdkl::where('kondisi', 'Baik')->count();
        $totalassetrusak = Barangdkl::where('kondisi', 'Rusak')->count();
        $totalassetperbaikan = Barangdkl::where('kondisi', 'Maintenance')->count();
        
        return response()->json([
            'totalasset' => $totalasset,
            'totalassetbaik' => $totalassetbaik,
            'totalassetrusak' => $totalassetrusak,
            'totalassetperbaikan' => $totalassetperbaikan,
        ]);
    }
    public function getAllAsset(Request $request) {
        $search = $request->input('search');
        if ($search) {
            // If there's a search query, filter the results
            $listbarang = Barang::where('nama_asset', 'LIKE', "%{$search}%")
                                ->orWhere('merk', 'LIKE', "%{$search}%")
                                ->leftJoin('kategoris', 'barangs.kategoriId', '=', 'kategoris.id')
                                ->orWhere('kategoris.nama', 'LIKE', "%{$search}%")
                                ->orWhere('user', 'LIKE', "%{$search}%")
                                ->leftJoin('jabatans', 'barangs.jabatanId', '=', 'jabatans.id')
                                ->orWhere('jabatans.nama', 'LIKE', "%{$search}%")
                                ->orWhere('lokasi', 'LIKE', "%{$search}%")
                                ->orWhere('dkasset', 'LIKE', "%{$search}%")
                                ->orWhere('kondisi', 'LIKE', "%{$search}%")
                                ->orWhere('tanggal', 'LIKE', "%{$search}%")
                                ->leftJoin('divisis', 'barangs.divisiId', '=', 'divisis.id')
                                ->orWhere('divisis.nama', 'LIKE', "%{$search}%")->get();
            $data = [
            'search'=>$search,
            'asset'=> $listbarang,
            ];
        } else {
            // If no search query, just paginate normally
            $listbarang = Barang::all();
            $data = [
                'search'=>false,
                'asset'=> $listbarang,
            ];
        }
        // $listbarang = Barang::paginate(20);
        return response()->json([
            'search' => $data['search'],
            'asset' => $data['asset'],
        ]);
    }
    public function getAllAssetDKL(Request $request) {
        $search = $request->input('search');
        if ($search) {
            // If there's a search query, filter the results
            $listbarang = Barangdkl::where('nama_asset', 'LIKE', "%{$search}%")
                                ->orWhere('merk', 'LIKE', "%{$search}%")
                                ->leftJoin('kategoris', 'barangs.kategoriId', '=', 'kategoris.id')
                                ->orWhere('kategoris.nama', 'LIKE', "%{$search}%")
                                ->orWhere('user', 'LIKE', "%{$search}%")
                                ->leftJoin('jabatans', 'barangs.jabatanId', '=', 'jabatans.id')
                                ->orWhere('jabatans.nama', 'LIKE', "%{$search}%")
                                ->orWhere('lokasi', 'LIKE', "%{$search}%")
                                ->orWhere('dkasset', 'LIKE', "%{$search}%")
                                ->orWhere('kondisi', 'LIKE', "%{$search}%")
                                ->orWhere('tanggal', 'LIKE', "%{$search}%")
                                ->leftJoin('divisis', 'barangs.divisiId', '=', 'divisis.id')
                                ->orWhere('divisis.nama', 'LIKE', "%{$search}%")->get();
            $data = [
            'search'=>$search,
            'asset'=> $listbarang,
            ];
        } else {
            // If no search query, just paginate normally
            $listbarang = Barangdkl::all();
            $data = [
                'search'=>false,
                'asset'=> $listbarang,
            ];
        }
        // $listbarang = Barang::paginate(20);
        return response()->json([
            'search' => $data['search'],
            'asset' => $data['asset'],
        ]);
    }
    public function showAsset($dkasset) {
        $asset = Barang::where(['dkasset' => $dkasset])->first();
        $history = History::where(['dkasset' => $dkasset])->get();
        $penyusutan = PenyusutanBarang::where(['dkasset' => $dkasset])->first();
        // dd($history);
        // Memeriksa jika $asset adalah null
        if (!$asset) {
            // Jika asset tidak ditemukan, coba mencari di Barangdkl
            $asset = Barangdkl::where(['dkasset' => $dkasset])->first();
        }
        if ($asset) {
            if($penyusutan){
                $data = [
                    'asset'=>$asset,
                    'history'=>$history,
                    'penyusutan'=>$penyusutan,
                ];
            }
            if(!$penyusutan){
                $data = [
                    'asset'=>$asset,
                    'history'=>$history,
                    'penyusutan'=>false,
                ];
            }
            // return view('admin.asset.detail', $data);
            return response()->json([
                'asset'=>$data['asset'],
                'history'=>$data['history'],
                'penyusutan'=>$data['penyusutan'],
            ]);
        }else {
            return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
            
        }
    }
}
