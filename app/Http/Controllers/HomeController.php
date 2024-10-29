<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
    public function index()
    {
        $listbarang = Barang::all();
        $totalasset = Barang::count();
        $totalassetbaik = Barang::where('kondisi', 'Baik')->count();
        $totalassetrusak = Barang::where('kondisi', 'Rusak')->count();
        $totalassetperbaikan = Barang::where('kondisi', 'Maintenance')->count();
        $data = [
            'asset'=> $listbarang,
            'totalasset'=> $totalasset,
            'totalassetbaik'=> $totalassetbaik,
            'totalassetrusak'=> $totalassetrusak,
            'totalassetperbaikan'=> $totalassetperbaikan,
        ];
        return view('dashboard', $data);
    }
}
