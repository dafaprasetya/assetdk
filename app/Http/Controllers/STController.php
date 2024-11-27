<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SerahTerima;
use App\Models\Barang;
use App\Models\Barangdkl;
use App\Models\Kategori;
use App\Models\Jabatan; 
use App\Models\Divisi; 
use App\Models\History; 
use Illuminate\Support\Facades\Storage;


class STController extends Controller
{
    public function index(Request $request) {
        $st = SerahTerima::paginate(20);
        $search = $request->input('search');

        $data = [
            'st'=>$st,
            'search'=>$search,
        ];
        return view('admin.asset.serahterimalist',$data);
    }
    public function buatserahterima() {
        $kategori = Kategori::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $asset = Barang::all();
        $assetdkl = Barangdkl::all();
        $data = [
            'title' => 'Tambah Asset',
            'kategori'=>$kategori,
            'divisi'=>$divisi,
            'divisi_penyerah'=>$divisi,
            'asset'=>$asset,
            'assetdkl'=>$assetdkl,
            'jabatan'=>$jabatan,
            'jabatan_penyerah' => $jabatan, 
        ];
        return view('admin.asset.serahterimacreate', $data);
    }
    public function create(Request $request) {
        $validatedData = $request->validate([
            'jenis_asset'=>'required',
            "dkasset"=>"required",
            "nama_penerima"=>'required',
            "jabatan_penerima"=>'required',
            "divisi_penerima"=>'required',
            "ttd_penerima"=>'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            "dkasset"=>"required",
            "nama_penyerah"=>'required',
            "jabatan_penyerah"=>'required',
            "divisi_penyerah"=>'required',
            "ttd_penyerah"=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
            "foto"=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
            "kondisi"=>'required',
            "tempat"=>'required',
            "bukti"=>'nullable',
            "deskripsi"=>'required',
        ]);

        $foto = $request->file('foto');
        
        
        $st = new SerahTerima();
        $st->jenis_asset = $validatedData["jenis_asset"];
        $st->dkasset = $validatedData["dkasset"];
        $st->nama_penerima = $validatedData["nama_penerima"];
        $st->divisi_penerima = $validatedData["divisi_penerima"];
        $st->jabatan_penerima = $validatedData["jabatan_penerima"];
        
        
        $ttd_penerima = $request->file('ttd_penerima');
        if ($ttd_penerima) {
            $nama_file_ttdpenerima = $ttd_penerima->hashName();
            $ttd_penerima->storeAs('public/signature_asset', $nama_file_ttdpenerima);
            $st->ttd_penerima = $nama_file_ttdpenerima;
            if ($validatedData["jenis_asset"] === 'DKASSET') {
                # code...
                $editbarang = Barang::where(['dkasset' => $validatedData["dkasset"]])->first();
                $editbarang->update([
                    'signature' => $nama_file_ttdpenerima,
                ]);
                $editbarang->save();
            }
            if ($validatedData["jenis_asset"] === 'DKL') {
                # code...
                $editbarang = Barangdkl::where(['dkasset' => $validatedData["dkasset"]])->first();
                $editbarang->update([
                    'signature' => $nama_file_ttdpenerima,
                ]);
                $editbarang->save();
            }
        }


        $st->nama_penyerah = $validatedData["nama_penyerah"];
        $st->divisi_penyerah = $validatedData["divisi_penyerah"];
        $st->jabatan_penyerah = $validatedData["jabatan_penyerah"];


        $ttd_penyerah = $request->file('ttd_penyerah');
        $nama_file_ttdpenyerah = $ttd_penyerah->hashName();
        $ttd_penyerah->storeAs('public/signature_asset', $nama_file_ttdpenyerah);
        $st->ttd_penyerah = $nama_file_ttdpenyerah;


        $nama_file_foto = $foto->hashName();
        $foto->storeAs('public/foto_asset', $nama_file_foto);
        $st->foto = $nama_file_foto; // Correctly assign the filename to the model
        
        $st->kondisi = $validatedData['kondisi']; // Correctly assign the filename to the model
        $st->tempat = $validatedData['tempat']; // Correctly assign the filename to the model
        $st->deskripsi = $validatedData['deskripsi']; // Correctly assign the filename to the model
        
        $bukti = $request->file('bukti');
        if ($bukti) {
            $nama_file_bukti = $bukti->hashName();
            $bukti->storeAs('public/bukti', $nama_file_bukti);
            $st->bukti = $nama_file_bukti;
        }
        $st->save();

        $history = new History();
        $history->dkasset = $validatedData["dkasset"];
        $history->pemegang = $validatedData['nama_penyerah'];
        $history->divisi_pemegang = $validatedData['divisi_penyerah'];
        $history->kondisi = $validatedData['kondisi'];
        $history->deskripsi = $validatedData['deskripsi'];
        $history->foto = $nama_file_foto;
        $history->ttd_pemegang = $nama_file_ttdpenyerah;
        
        if ($validatedData["jenis_asset"] === 'DKASSET') {
            $editbarang = Barang::where(['dkasset' => $validatedData["dkasset"]])->first();
            $history->waktu = $editbarang->tanggal .' sampai '. date('d-m-Y');        
        }
        if ($validatedData["jenis_asset"] === 'DKL') {
            $editbarang = Barangdkl::where(['dkasset' => $validatedData["dkasset"]])->first();
            $history->waktu = $editbarang->tanggal .' sampai '. date('d-m-Y');        
        }
        $history->save();
        $getjabatanpenerima = Jabatan::where(['nama' => $validatedData["jabatan_penerima"]])->first()->id;
        $getdivisipenerima = Divisi::where(['nama' => $validatedData["divisi_penerima"]])->first()->id;
        // dd($getjabatanpenerima, $getdivisipenerima);
        if ($validatedData["jenis_asset"] === 'DKASSET') {
            $editbarang = Barang::where(['dkasset' => $validatedData["dkasset"]])->first();
            $editbarang->update([
                'user' => $validatedData["nama_penerima"],
                'jabatanId' => $getjabatanpenerima,
                'divisiId' => $getdivisipenerima,
                'kondisi' => $validatedData["kondisi"],
                'foto' => $nama_file_foto,
                'status' => $validatedData['deskripsi'],
                'tanggal' => date('Y-m-d'),
            ]);
            $editbarang->save();
        }
        if ($validatedData["jenis_asset"] === 'DKL') {
            $editbarang = Barangdkl::where(['dkasset' => $validatedData["dkasset"]])->first();
            $editbarang->update([
                'user' => $validatedData["nama_penerima"],
                'jabatanId' => $getjabatanpenerima,
                'divisiId' => $getdivisipenerima,
                'kondisi' => $validatedData["kondisi"],
                'foto' => $nama_file_foto,
                'status' => $validatedData['deskripsi'],
                'tanggal' => date('d-m-Y'),
            ]);
            $editbarang->save();
        }
        
        return redirect()->route('showserahterima', $st->id)->with('success'.'serahterima telah masuk ke database!');

    }
    public function show($id) {
        $asset = SerahTerima::findOrFail($id);
        $barang = Barang::where(['dkasset'=>$asset->dkasset])->first();
        if(!$barang){
            $barang = Barangdkl::where(['dkasset'=>$asset->dkasset])->first();

        }
        if ($asset) {
            $data = [
                'asset'=>$asset,
                'barang'=>$barang,
            ];
            return view('admin.asset.showserahterima', $data);
        }else {
            return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
            
        }
    }
    public function edit($id) {
        $serahterima = SerahTerima::findOrFail($id);
        $kategori = Kategori::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $asset = Barang::all();
        $assetdkl = Barangdkl::all();
        $data = [
            'title' => 'Tambah Asset',
            'kategori'=>$kategori,
            'divisi'=>$divisi,
            'divisi_penyerah'=>$divisi,
            'asset'=>$asset,
            'assetdkl'=>$assetdkl,
            'jabatan'=>$jabatan,
            'jabatan_penyerah' => $jabatan, 
            'serahterima' => $serahterima, 
        ];
        return view('admin.asset.serahterimacreate', $data);
    }
    public function editpost(Request $request, $id) {
        
        $foto = $request->file('foto');
        $st = SerahTerima::findOrFail($id);
        $st->update([
            'dkasset' => $request->dkasset,
            'nama_penerima' => $request->nama_penerima,
            'jabatan_penerima' => $request->jabatan_penerima,
            'divisi_penerima' => $request->divisi_penerima,
        ]);
        // $st->dkasset = $validatedData["dkasset"];
        // $st->nama_penerima = $validatedData["nama_penerima"];
        // $st->divisi_penerima = $validatedData["divisi_penerima"];
        // $st->jabatan_penerima = $validatedData["jabatan_penerima"];
        
        
        $ttd_penerima = $request->file('ttd_penerima');
        if ($ttd_penerima) {
            $nama_file_ttdpenerima = $ttd_penerima->hashName();
            $ttd_penerima->storeAs('public/signature_asset', $nama_file_ttdpenerima);
            $st->update([
                'ttd_penerima' => $nama_file_ttdpenerima,
            ]);
            // $st->ttd_penerima = $nama_file_ttdpenerima;
            $editbarang = Barang::where(['dkasset' => $request->dkasset])->first();
            $editbarang->update([
                'signature' => $nama_file_ttdpenerima,
            ]);
        }

        $st->update([
            'nama_penyerah' => $request->nama_penyerah,
            'divisi_penyerah' => $request->divisi_penyerah,
            'jabatan_penyerah' => $request->jabatan_penyerah,
        ]);
        // $st->nama_penyerah = $validatedData["nama_penyerah"];
        // $st->divisi_penyerah = $validatedData["divisi_penyerah"];
        // $st->jabatan_penyerah = $validatedData["jabatan_penyerah"];


        $ttd_penyerah = $request->file('ttd_penyerah');
        $nama_file_ttdpenyerah = $ttd_penyerah->hashName();
        $ttd_penyerah->storeAs('public/signature_asset', $nama_file_ttdpenyerah);
        // $st->ttd_penyerah = $nama_file_ttdpenyerah;
        $st->update([
            'ttd_penyerah'=>$nama_file_ttdpenyerah,
        ]);

        $nama_file_foto = $foto->hashName();
        $foto->storeAs('public/foto_asset', $nama_file_foto);
        $st->update([
            'foto'=>$nama_file_foto,
            'kondisi'=>$request->kondisi,
            'tempat'=>$request->tempat,
            'deskripsi'=>$request->deskripsi,
        ]);
        // $st->foto = $nama_file_foto;
        // $st->kondisi = $validatedData['kondisi']; 
        // $st->tempat = $validatedData['tempat']; 
        // $st->deskripsi = $validatedData['deskripsi']; 
        
        $bukti = $request->file('bukti');
        if ($bukti) {
            $nama_file_bukti = $bukti->hashName();
            $bukti->storeAs('public/bukti', $nama_file_bukti);
            $st->update([
                'bukti' => $nama_file_bukti,
            ]);
            // $st->bukti = $nama_file_bukti;
        }
        $st->save();

        $history = new History();
        $history->dkasset = $request->dkasset;
        $history->pemegang = $request->nama_penyerah;
        $history->divisi_pemegang = $request->divisi_penyerah;
        $history->kondisi = $request->kondisi;
        $history->deskripsi = $request->deskripsi;
        $history->foto = $nama_file_foto;
        $history->ttd_pemegang = $nama_file_ttdpenyerah;
        $editbarang = Barang::where(['dkasset' => $request->dkasset])->first();
        $history->waktu = $editbarang->tanggal .' sampai '. date('Y-m-d');        
        $history->save();

        $getjabatanpenerima = Jabatan::where(['nama' => $request->jabatan_penerima])->first()->id;
        $getdivisipenerima = Divisi::where(['nama' => $request->divisi_penerima])->first()->id;
        // dd($getjabatanpenerima, $getdivisipenerima);
        $editbarang->update([
            'user' => $request->nama_penerima,
            'jabatanId' => $getjabatanpenerima,
            'divisiId' => $getdivisipenerima,
            'kondisi' => $request->kondisi,
            'foto' => $nama_file_foto,
            'status' => $request->deskripsi,
            'tanggal' => date('Y-m-d'),
        ]);
        $editbarang->save();
        
        return redirect()->route('showserahterima', $st->id)->with('success'.'serahterima telah masuk ke database!');

    }
    public function delete($id) {
        $asset = SerahTerima::findOrFail($id);
        if ($asset) {
            $asset->delete();
            return redirect()->route('serahterima')->with('success', 'Serah Terima berhasil dihapus');
        }else {
            return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
            
        }
    }
}
