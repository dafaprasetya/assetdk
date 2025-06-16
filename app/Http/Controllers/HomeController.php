<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barangdkl;
use App\Models\Divisi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $listbarang = Barang::all();
        $totalasset = $listbarang->count();
        $totalassetbaik = Barang::where('kondisi', 'Baik')->count();
        $totalassetrusak = Barang::where('kondisi', 'Rusak')->count();
        $totalassetperbaikan = Barang::where('kondisi', 'Maintenance')->count();
        function getkat() {
            $kategoriData = [];  // Membuat array kosong untuk menampung data divisi
            $kat = Kategori::all();
            foreach ($kat as $kate) {
                // $nama_divisi = str_replace([" ", "&"], ["_", "dan"], $divi->nama);  // Ganti spasi dan "&"
                // // Menyimpan jumlah barang berdasarkan divisi dengan nama divisi sebagai kunci
                // $warna_hex = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                // $divisiData[$nama_divisi] = Barang::where('divisiId', $divi->id)->count();
                // // Menambahkan warna hex acak
                $nama_divisi = str_replace([" ", "&"], ["_", "dan"], $kate->nama);
                $jumlah_kategori = Barang::where('kategoriId', $kate->id)->count();

                // Menambahkan warna hex acak
                $warna_hex = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $kategoriData[$nama_divisi] = [
                    'jumlah' => $jumlah_kategori,
                    'warna' => $warna_hex,
                ];
            }
            return $kategoriData;  // Mengembalikan array hasil
            // return $data;
        }
        $kategori = getkat();
        // dd($listbarang);
        $data = [
            'asset'=> $listbarang,
            'totalasset'=> $totalasset,
            'totalassetbaik'=> $totalassetbaik,
            'totalassetrusak'=> $totalassetrusak,
            'totalassetperbaikan'=> $totalassetperbaikan,
            'kategori'=>$kategori,
            'search'=>$search,
        ];
        // dd($testing);
        return view('dashboard', $data);
    }
    public function indexdkl(Request $request)
    {
        $search = $request->input('search');
        $listbarang = Barangdkl::all();
        $totalasset = $listbarang->count();
        $totalassetbaik = Barangdkl::where('kondisi', 'Baik')->count();
        $totalassetrusak = Barangdkl::where('kondisi', 'Rusak')->count();
        $totalassetperbaikan = Barangdkl::where('kondisi', 'Maintenance')->count();
        function getkat() {
            $kategoriData = [];  // Membuat array kosong untuk menampung data divisi
            $kat = Kategori::all();
            foreach ($kat as $kate) {
                $nama_divisi = str_replace([" ", "&"], ["_", "dan"], $kate->nama);
                $jumlah_kategori = Barangdkl::where('kategoriId', $kate->id)->count();

                // Menambahkan warna hex acak
                $warna_hex = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $kategoriData[$nama_divisi] = [
                    'jumlah' => $jumlah_kategori,
                    'warna' => $warna_hex,
                ];
            }
            return $kategoriData;  // Mengembalikan array hasil
            // return $data;count()
        }
        $kategori = getkat();
        // dd($listbarang);
        $data = [
            'asset'=> $listbarang,
            'totalasset'=> $totalasset,
            'totalassetbaik'=> $totalassetbaik,
            'totalassetrusak'=> $totalassetrusak,
            'totalassetperbaikan'=> $totalassetperbaikan,
            'kategori'=>$kategori,
            'search'=>$search,

        ];
        // dd($testing);
        return view('dashboard', $data);
    }
}
