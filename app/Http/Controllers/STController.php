<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SerahTerima;
use App\Models\Barang;
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
        $data = [
            'title' => 'Tambah Asset',
            'kategori'=>$kategori,
            'divisi'=>$divisi,
            'divisi_penyerah'=>$divisi,
            'asset'=>$asset,
            'jabatan'=>$jabatan,
            'jabatan_penyerah' => $jabatan, 
        ];
        return view('admin.asset.serahterimacreate', $data);
    }
    public function create(Request $request) {
        $validatedData = $request->validate([
            "dkasset"=>"required",
            "nama_penerima"=>'required',
            "jabatan_penerima"=>'required',
            "divisi_penerima"=>'required',
            "ttd_penerima"=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
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
        $st->dkasset = $validatedData["dkasset"];
        $st->nama_penerima = $validatedData["nama_penerima"];
        $st->divisi_penerima = $validatedData["divisi_penerima"];
        $st->jabatan_penerima = $validatedData["jabatan_penerima"];
        
        
        $ttd_penerima = $request->file('ttd_penerima');
        $nama_file_ttdpenerima = $ttd_penerima->hashName();
        $ttd_penerima->storeAs('public/signature_asset', $nama_file_ttdpenerima);
        $st->ttd_penerima = $nama_file_ttdpenerima;


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
        $editbarang = Barang::where(['dkasset' => $validatedData["dkasset"]])->first();
        $history->waktu = $editbarang->tanggal .' sampai '. date('d-m-Y');        
        $history->save();

        $getjabatanpenerima = Jabatan::where(['nama' => $validatedData["jabatan_penerima"]])->first()->id;
        $getdivisipenerima = Divisi::where(['nama' => $validatedData["divisi_penerima"]])->first()->id;
        // dd($getjabatanpenerima, $getdivisipenerima);
        $editbarang->update([
            'user' => $validatedData["nama_penerima"],
            'jabatanId' => $getjabatanpenerima,
            'divisiId' => $getdivisipenerima,
            'kondisi' => $validatedData["kondisi"],
            'signature' => $nama_file_ttdpenerima,
            'foto' => $nama_file_foto,
            'status' => $validatedData['deskripsi'],
            'tanggal' => date('d-m-Y'),
        ]);
        $editbarang->save();

        return redirect()->route('serahterima')->with('success'.'serahterima telah masuk ke database!');

    }
    public function show($id) {
        $asset = SerahTerima::findOrFail($id);
        if ($asset) {
            $data = [
                'asset'=>$asset,
            ];
            return view('admin.asset.showserahterima', $data);
        }else {
            return redirect()->route('listasset')->with('error', 'Asset tidak ditemukan');
            
        }
    }
}
