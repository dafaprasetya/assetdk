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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


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
            return response()->json([
                'error'=>true,
                'message'=>'asset tidak ditemukan'
            ]);
            // return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
            
        }
    }
    public function insertAsset(Request $request) {
        $validatedData = Validator::make($request->all(), [
            "jenis_asset"=>"required",
            "dkasset"=>"required|unique:barangs,dkasset",
            "nama_asset"=>'required',
            "merk"=>'required',
            "kategori"=>'required',
            "user"=>'required',
            "jabatan"=>'required',
            "divisi"=>'required',
            "area"=>'required',
            "lokasi"=>'required',
            "status_aktif"=>'required',
            "kondisi"=>'required',
            "QTY"=>'required',
            "foto"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            "asset_validasi"=>'required',
            "tanggal"=>'required',
            "signature"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            "foto_tanda_terima"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            "keterangan_asset"=>'required',
            "status_label_kode"=>'required',
            "status"=>'required',
            // "tangal_pembelian"=>'nullable',
            // "harga_awal"=>'nullable',
            // "harga_penyusutan_perhari"=>'nullable',
            
        ]);
        if($validatedData->fails()){
            return response()->json([
                'success' => false,
                'message' => $validatedData->errors(),
            ], 422);
        }
        $penyusutan = new PenyusutanBarang();
        $penyusutan->dkasset = $request->dkasset;
        $penyusutan->tanggal_pembelian = $request->tanggal_pembelian;
        $penyusutan->harga_awal = $request->harga_awal;
        $penyusutan->harga_penyusutan_perhari = $request->harga_penyusutan_perhari;
        $penyusutan->save();
        // dd($penyusutan);


        // Handle file upload if exists

        $foto = $request->file('foto');
        $foto_tanda_terima = $request->file('foto_tanda_terima');
        $foto_signature = $request->file('signature');

        
        // Assign validated data to the Barang object
        if ($request->jenis_asset === 'DKASSET') {
            $barang = new Barang();
            $barang->dkasset = $request->dkasset;
            $barang->nama_asset = $request->nama_asset;
            $barang->merk = $request->merk;
            $barang->kategoriId = $request->kategori;
            $barang->user = $request->user;
            $barang->jabatanId = $request->jabatan;
            $barang->divisiId = $request->divisi;
            $barang->area = $request->area;
            $barang->lokasi = $request->lokasi;
            $barang->status_aktif = $request->status_aktif;
            $barang->kondisi = $request->kondisi;
            $barang->QTY = $request->QTY;
            // Save file paths to the model
            if($foto){
                $nama_file_foto = $request->dkasset."_".$foto->getClientOriginalName();
                $foto->storeAs('public/foto_asset', $nama_file_foto);
                $barang->foto = $nama_file_foto; // Correctly assign the filename to the model
            }
            
            if ($foto_tanda_terima) {
                $nama_file_foto_tanda_terima = 'tandaterima'.$request->dkasset."_".$foto_tanda_terima->getClientOriginalName();
                $foto_tanda_terima->storeAs('public/foto_tanda_terima_asset', $nama_file_foto_tanda_terima);
                $barang->foto_tanda_terima = $nama_file_foto_tanda_terima;
            }
            
            $barang->asset_validasi = $request->asset_validasi;
            $barang->tanggal = $request->tanggal;
            if ($foto_signature) {
                $nama_file_signature= $request->dkasset."_".$foto_signature->getClientOriginalName();
                $foto_signature->storeAs('public/signature_asset', $nama_file_signature);
                $barang->signature = $nama_file_signature;
            }
            $barang->keterangan_asset = $request->keterangan_asset;
            $barang->status_label_kode = $request->status_label_kode;
            $barang->status = $request->status;
    
            // Save the Barang object
            $barang->save();
        }
        if ($request->jenis_asset === 'DKL') {
            $barang = new Barangdkl();
            $validatedData = $request->validate([
                "jenis_asset"=>"required",
                "dkasset"=>"required|unique:barangdkls,dkasset",
                "nama_asset"=>'required',
                "merk"=>'required',
                "kategori"=>'required',
                "user"=>'required',
                "jabatan"=>'required',
                "divisi"=>'required',
                "area"=>'required',
                "lokasi"=>'required',
                "status_aktif"=>'required',
                "kondisi"=>'required',
                "QTY"=>'required',
                "foto"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                "asset_validasi"=>'required',
                "tanggal"=>'required',
                "signature"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                "foto_tanda_terima"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                "keterangan_asset"=>'required',
                "status_label_kode"=>'required',
                "status"=>'required',
            ]);
            $barang->dkasset = $validatedData["dkasset"];
            $barang->nama_asset = $validatedData["nama_asset"];
            $barang->merk = $validatedData["merk"];
            $barang->kategoriId = $validatedData["kategori"];
            $barang->user = $validatedData["user"];
            $barang->jabatanId = $validatedData["jabatan"];
            $barang->divisiId = $validatedData["divisi"];
            $barang->area = $validatedData["area"];
            $barang->lokasi = $validatedData["lokasi"];
            $barang->status_aktif = $validatedData["status_aktif"];
            $barang->kondisi = $validatedData["kondisi"];
            $barang->QTY = $validatedData["QTY"];
            // Save file paths to the model
            if($foto){
                $nama_file_foto = $validatedData["dkasset"]."_".$foto->getClientOriginalName();
                $foto->storeAs('public/foto_asset', $nama_file_foto);
                $barang->foto = $nama_file_foto; // Correctly assign the filename to the model
            }
            
            if ($foto_tanda_terima) {
                $nama_file_foto_tanda_terima = 'tandaterima'.$validatedData["dkasset"]."_".$foto_tanda_terima->getClientOriginalName();
                $foto_tanda_terima->storeAs('public/foto_tanda_terima_asset', $nama_file_foto_tanda_terima);
                $barang->foto_tanda_terima = $nama_file_foto_tanda_terima;
            }
            
            $barang->asset_validasi = $validatedData["asset_validasi"];
            $barang->tanggal = $validatedData["tanggal"];
            if ($foto_signature) {
                $nama_file_signature= $validatedData["dkasset"]."_".$foto_signature->getClientOriginalName();
                $foto_signature->storeAs('public/signature_asset', $nama_file_signature);
                $barang->signature = $nama_file_signature;
            }
            $barang->keterangan_asset = $validatedData["keterangan_asset"];
            $barang->status_label_kode = $validatedData["status_label_kode"];
            $barang->status = $validatedData["status"];
    
            // Save the Barang object
            $barang->save();
        }
       
        return response()->json([
            'success' => true,
            'message' => 'data berhasil masuk ke database'
        ]);
    }
    public function editAsset(Request $request, $dkasset) {
        $asset = Barang::where(['dkasset' => $dkasset])->first();
        $penyusutan = PenyusutanBarang::where(['dkasset' => $dkasset])->first();
    
        // Memeriksa jika $asset adalah null
        if (!$asset) {
            // Jika asset tidak ditemukan, coba mencari di Barangdkl
            $asset = Barangdkl::where(['dkasset' => $dkasset])->first();
        }
        if (!$penyusutan) {
            $penyusutan = new PenyusutanBarang();
            $penyusutan->dkasset = $request->dkasset;
            $penyusutan->tanggal_pembelian = $request->tanggal_pembelian;
            $penyusutan->harga_awal = $request->harga_awal;
            $penyusutan->harga_penyusutan_perhari = $request->harga_penyusutan_perhari;
            $penyusutan->save();
        }
        // $penyusutan = new PenyusutanBarang();
        $penyusutan->update([
            'dkasset' => $request->dkasset,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'harga_awal' => $request->harga_awal,
            'harga_penyusutan_perhari' => $request->harga_penyusutan_perhari,
        ]);
        $penyusutan->save();

        $asset->update([
            "dkasset"=>$request->dkasset,
            "nama_asset"=>$request->nama_asset,
            "merk"=>$request->merk,
            "kategoriId"=>$request->kategori,
            "user"=>$request->user,
            "jabatanId"=>$request->jabatan,
            "divisiId"=>$request->divisi,
            "area"=>$request->area,
            "lokasi"=>$request->lokasi,
            "status_aktif"=>$request->status_aktif,
            "kondisi"=>$request->kondisi,
            "QTY"=>$request->QTY,
            "asset_validasi"=>$request->asset_validasi,
            "tanggal"=>$request->tanggal,
            "keterangan_asset"=>$request->keterangan_asset,
            "status_label_kode"=>$request->status_label_kode,
            "status"=>$request->status,
        ]);
        $asset->save();
        $foto = $request->file('foto');
        $foto_tanda_terima = $request->file('foto_tanda_terima');
        $foto_signature = $request->file('signature');
        if ($foto) {
            Storage::delete('public/foto_asset/' . $asset->foto);
            $nama_file_foto = $request->dkasset."_".$foto->getClientOriginalName();
            $foto->storeAs('public/foto_asset', $nama_file_foto);
            $asset->update([
                'foto' =>$nama_file_foto,
            ]);
            $asset->save();
        }
        if ($foto_tanda_terima) {
            Storage::delete('public/foto_tanda_terima_asset/' . $asset->foto_tanda_terima);
            $nama_file_foto_tanda_terima = 'tandaterima'.$request->dkasset."_".$foto_tanda_terima->getClientOriginalName();
            $foto_tanda_terima->storeAs('public/foto_tanda_terima_asset', $nama_file_foto_tanda_terima);
            $asset->update([
                'foto_tanda_terima'=>$nama_file_foto_tanda_terima,
            ]);
            $asset->save();
        }
        if ($foto_signature) {
            Storage::delete('public/signature_asset/' . $asset->signature);
            $nama_file_signature= $request->dkasset."_".$foto_signature->getClientOriginalName();
            $foto_signature->storeAs('public/signature_asset', $nama_file_signature);
            $asset->update([
                'signature'=>$nama_file_signature,
            ]);
            $asset->save();
        }
        return response()->json([
            'success' => true,
            'message'=>'data berhasil di edit',
        ]);
    }
}
