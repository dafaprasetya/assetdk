<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barangdkl;
use App\Models\Kategori;
use App\Models\PenyusutanBarang;
use App\Models\Jabatan; 
use App\Models\Divisi;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AssetController extends Controller
{
    public function __construct()
    {
        // $this->middleware('asset');
        // $this->middleware('IT');
    }
    public function index(Request $request) {
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
                                ->orWhere('divisis.nama', 'LIKE', "%{$search}%")->paginate(20)->appends(['search' => $search]);
            $data = [
            'search'=>$search,
            'asset'=> $listbarang,
            ];
        } else {
            // If no search query, just paginate normally
            $listbarang = Barang::paginate(20);
            $data = [
                'search'=>false,
                'asset'=> $listbarang,
            ];
        }
        // $listbarang = Barang::paginate(20);
        return view('admin.asset.barang', $data);
    }
    public function indexdkl(Request $request) {
        $search = $request->input('search');
        if ($search) {
            // If there's a search query, filter the results
            $listbarang = Barangdkl::where('nama_asset', 'LIKE', "%{$search}%")
                                ->orWhere('merk', 'LIKE', "%{$search}%")
                                ->leftJoin('kategoris', 'barangdkls.kategoriId', '=', 'kategoris.id')
                                ->orWhere('kategoris.nama', 'LIKE', "%{$search}%")
                                ->orWhere('user', 'LIKE', "%{$search}%")
                                ->leftJoin('jabatans', 'barangdkls.jabatanId', '=', 'jabatans.id')
                                ->orWhere('jabatans.nama', 'LIKE', "%{$search}%")
                                ->orWhere('lokasi', 'LIKE', "%{$search}%")
                                ->orWhere('dkasset', 'LIKE', "%{$search}%")
                                ->orWhere('kondisi', 'LIKE', "%{$search}%")
                                ->leftJoin('divisis', 'barangdkls.divisiId', '=', 'divisis.id')
                                ->orWhere('divisis.nama', 'LIKE', "%{$search}%")->paginate(20)->appends(['search' => $search]);
            $data = [
            'search'=>$search,
            'asset'=> $listbarang,
            ];
        } else {
            // If no search query, just paginate normally
            $listbarang = Barangdkl::paginate(20);
            $data = [
                'search'=>false,
                'asset'=> $listbarang,
            ];
        }
        // $listbarang = Barang::paginate(20);
        return view('admin.asset.barang', $data);
    }
    
    public function tambahbarang() {
        $kategori = Kategori::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $data = [
            'title' => 'Tambah Asset',
            'kategori'=>$kategori,
            'divisi'=>$divisi,
            'jabatan'=>$jabatan,
        ];
        return view('admin.asset.create', $data);
    }
    public function show($dkasset) {
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
                ];
            }
            return view('admin.asset.detail', $data);
        }else {
            return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
            
        }
    }
    public function cetaksemua(Request $request) {
        // $list = Barang::all();
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
        } else {
            // If no search query, just paginate normally
            $listbarang = Barang::all();
        }
        $data = [
            'asset'=>$listbarang,
        ];
        // foreach ($listbarang as $listbarang) {
        //     # code...
        //     dd($listbarang);
        // }
        return view('admin.asset.cetak', $data);
    }
    public function cetakdkl(Request $request) {
        // $list = Barang::all();
        $search = $request->input('search');
        if ($search) {
            // If there's a search query, filter the results
            $listbarang = Barangdkl::where('nama_asset', 'LIKE', "%{$search}%")
                                ->orWhere('merk', 'LIKE', "%{$search}%")
                                ->leftJoin('kategoris', 'barangdkls.kategoriId', '=', 'kategoris.id')
                                ->orWhere('kategoris.nama', 'LIKE', "%{$search}%")
                                ->orWhere('user', 'LIKE', "%{$search}%")
                                ->leftJoin('jabatans', 'barangdkls.jabatanId', '=', 'jabatans.id')
                                ->orWhere('jabatans.nama', 'LIKE', "%{$search}%")
                                ->orWhere('lokasi', 'LIKE', "%{$search}%")
                                ->orWhere('dkasset', 'LIKE', "%{$search}%")
                                ->orWhere('kondisi', 'LIKE', "%{$search}%")
                                ->leftJoin('divisis', 'barangdkls.divisiId', '=', 'divisis.id')
                                ->orWhere('divisis.nama', 'LIKE', "%{$search}%")->get();
        } else {
            // If no search query, just paginate normally
            $listbarang = Barangdkl::all();
        }
        $data = [
            'asset'=>$listbarang,
        ];
        return view('admin.asset.cetak', $data);
    }
    public function hapus(Request $request, $dkasset) {
        $asset = Barang::where(['dkasset' => $dkasset])->first();
    
        // Memeriksa jika $asset adalah null
        if (!$asset) {
            // Jika asset tidak ditemukan, coba mencari di Barangdkl
            $asset = Barangdkl::where(['dkasset' => $dkasset])->first();
        }
        if ($asset) {
            if ($asset->foto) {
                Storage::delete('public/foto_asset/' . $asset->foto);
            }
            if ($asset->foto_tanda_terima) {
                Storage::delete('public/foto_tanda_terima_asset/' . $asset->foto_tanda_terima);
            }
            if ($asset->signature) {
                Storage::delete('public/signature_asset/' . $asset->signature);
            }
            $asset->delete();
    
            return redirect()->route('listasset')->with('success', $dkasset.' telah dihapus');
        }
    
        return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
    }
    public function edit($dkasset) {
        $asset = Barang::where(['dkasset' => $dkasset])->first();
        $penyusutan = PenyusutanBarang::where(['dkasset' => $dkasset])->first();
    
        // Memeriksa jika $asset adalah null
        if (!$asset) {
            // Jika asset tidak ditemukan, coba mencari di Barangdkl
            $asset = Barangdkl::where(['dkasset' => $dkasset])->first();
        }
        $kategori = Kategori::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $data = [
            'asset'=>$asset,
            'title' => 'Tambah Asset',
            'kategori'=>$kategori,
            'divisi'=>$divisi,
            'jabatan'=>$jabatan,
            'penyusutan'=>$penyusutan,
        ];
        return view('admin.asset.create', $data);
    }
    public function editpost(Request $request, $dkasset) {
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
            // "jenis_asset"=>$request->jenis_asset,
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
        return redirect()->route('listasset')->with('success', $request->dkasset.' berhasil di updata');
    }
    public function tambahbarangpost(Request $request) {
        $validatedData = $request->validate([
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
            "foto"=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
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

        $penyusutan = new PenyusutanBarang();
        $penyusutan->dkasset = $validatedData['dkasset'];
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
        if ($validatedData["jenis_asset"] === 'DKASSET') {
            $barang = new Barang();
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
            $nama_file_foto = $validatedData["dkasset"]."_".$foto->getClientOriginalName();
            $foto->storeAs('public/foto_asset', $nama_file_foto);
            $barang->foto = $nama_file_foto; // Correctly assign the filename to the model
            
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
        if ($validatedData["jenis_asset"] === 'DKL') {
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
                "foto"=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
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
            $nama_file_foto = $validatedData["dkasset"]."_".$foto->getClientOriginalName();
            $foto->storeAs('public/foto_asset', $nama_file_foto);
            $barang->foto = $nama_file_foto; // Correctly assign the filename to the model
            
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

        return redirect()->route('listasset')->with('success', $validatedData['dkasset'].' telah masuk ke database!');
        

    }
    

    public function serahterima() {
        $kategori = Kategori::all();
        $data = [
            'title' => 'Serah Terima',
            'kategori'=>$kategori,
        ];
        return view('admin.asset.create', $data);
    }

    public function serahterimaup(Request $request) {
        $validatedData = $request->validate([
            ''
        ]);
    }


    public function hitungPenyusutan(Request $request, $dkasset)
    {
        $penyusutan = PenyusutanBarang::where('dkasset', $dkasset)->first();

        if (!$penyusutan) {
            return redirect()->route('detailasset',$dkasset)->with('gaketemu', $request->dkasset.'Errorrr');
        }

        $hargaAwal = (float)$penyusutan->harga_awal;
        $tanggalPembelian = Carbon::parse($penyusutan->tanggal_pembelian);
        $hargaPenyusutanPerHari = $penyusutan->harga_penyusutan_perhari;

        // Validasi data
        if (!$hargaAwal || !$tanggalPembelian) {
            return redirect()->route('detailasset',$dkasset)->with('error', 'Data harga awal atau tanggal pembelian tidak valid.');
        }
        
        // // Hitung masa manfaat berdasarkan tanggal pembelian
        // $masaManfaat = $tanggalPembelian->diffInDays(now());

        // // Hitung harga penyusutan per hari
        // if ($masaManfaat > 0) {
        //     $hargaPenyusutanPerHari = $hargaAwal / $masaManfaat;
        // }

        // Hitung total penyusutan berdasarkan jumlah hari sejak pembelian
        // dd($hargaPenyusutanPerHari);
        $jumlahHariSejakPembelian = $tanggalPembelian->diffInDays(now());
        $totalPenyusutan = $jumlahHariSejakPembelian * $hargaPenyusutanPerHari;

        // Hitung nilai saat ini
        $nilaiSaatIni = max(0, $hargaAwal - $totalPenyusutan);

        // Update tabel dengan hasil perhitungan
        $penyusutan->update([
            // 'harga_penyusutan_perhari' => round($hargaPenyusutanPerHari, 2),
            'harga_penyusutan' => round($nilaiSaatIni, 2),
        ]);
        
        return redirect()->route('detailasset',$dkasset)->with('success', 'Harga Berhasil Di Update');
        // Return hasil
        // return response()->json([
        //     'dkasset' => $penyusutan->dkasset,
        //     'harga_awal' => $hargaAwal,
        //     'harga_penyusutan_perhari' => round($hargaPenyusutanPerHari, 2),
        //     'harga_penyusutan' => round($totalPenyusutan, 2),
        //     'nilai_saat_ini' => round($nilaiSaatIni, 2),
        //     'tanggal_pembelian' => $tanggalPembelian->toDateString(),
        // ]);
    }


}
