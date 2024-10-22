<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $listbarang = Barang::all();
        $data = [
            'asset'=> $listbarang,
        ];
        return view('admin.asset.barang', $data);
    }
    public function tambahbarang() {
        $kategori = Kategori::all();
        $data = [
            'title' => 'Tambah Asset',
            'kategori'=>$kategori,
        ];
        return view('admin.asset.create', $data);
    }
    public function tambahbarangpost(Request $request) {
        $validatedData = $request->validate([
            'idbarang'=>'required|unique:barangs,idbarang',
            'nama'=>'required',
            'kategori'=>'required',
            'milik'=>'required',
            'nama_pemegang'=>'required',
            'nik_pemegang'=>'required',
            'divisi_pemegang'=>'required',
            'kondisi'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $file = $request->file('file');
        $barang = new Barang();
        $barang->idbarang = $validatedData["idbarang"];
        $barang->nama = $validatedData["nama"];
        $barang->kategori_id = $validatedData["kategori"];
        $barang->milik = $validatedData["milik"];
        $barang->nama_pemegang = $validatedData["nama_pemegang"];
        $barang->nik_pemegang = $validatedData["nik_pemegang"];
        $barang->divisi_pemegang = $validatedData["divisi_pemegang"];
        $barang->kondisi = $validatedData["kondisi"];
        $barang->deskripsi = $validatedData["deskripsi"];
        $barang->ditambahkan_oleh = Auth::user()->nama;
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);

        $barang->save();

        return redirect()->route('listasset')->with('success', 'data telah diinput');
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
}
