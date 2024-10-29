<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kategori;
use App\Models\Jabatan; 
use App\Models\Divisi; 
use App\Models\User; 

class ITController extends Controller
{
    // KATEGORIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
    public function kategorilist() {
        $kategori = Kategori::all();
        $data = [
            'kategori' => $kategori,
        ];
        return view('admin.IT.kategori',$data);
    }
    public function deletekategori(Request $request, $id) {
        $asset = Kategori::findOrFail($id);
        if($asset){
            $asset->delete();
            return redirect()->route('kategorilist')->with('success', $asset->nama.' telah dihapus');
        }
        return redirect()->route('kategorilist')->with('error', 'item tidak ditemukan');
        
    }
    public function editkategori(Request $request, $id) {
        $asset = Kategori::findOrFail($id);
        $validateData = $request->validate([
            'nama' => 'required|unique:kategoris,nama',
            'deskripsi' => 'nullable'
        ]);
        if ($asset) {
            $asset->update([
                'nama'=>$validateData['nama'],
                'deskripsi'=>$validateData['deskripsi'],
            ]);
            $asset->save();
            return redirect()->route('kategorilist')->with('success', $asset->nama.' telah berhasil diupdate');
        }
        return redirect()->route('kategorilist')->with('error', 'data tidak ditemukan');
    
    }
    public function buatkategori(Request $request) {
        $validateData = $request->validate([
            'nama' => 'required|unique:kategoris,nama',
            'deskripsi' => 'nullable'
        ]);
        $kategori = new Kategori();
        $kategori->nama = $validateData['nama'];
        $kategori->deskripsi = $validateData['deskripsi'];
        $kategori->save();

        return redirect()->route('kategorilist')->with('success', $validateData['nama'].' berhasil ditambah');
    }
    // JABATANNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
    public function jabatanlist() {
        $jabatan = Jabatan::all();
        $data = [
            'jabatan' => $jabatan,
        ];
        return view('admin.IT.jabatan',$data);
    }
    public function deletejabatan(Request $request, $id) {
        $jabatan = Jabatan::findOrFail($id);
        if($jabatan){
            $jabatan->delete();
            return redirect()->route('jabatanlist')->with('success', $jabatan->nama.' telah dihapus');
        }
        return redirect()->route('jabatanlist')->with('error', 'item tidak ditemukan');
        
    }
    public function editjabatan(Request $request, $id) {
        $jabatan = Jabatan::findOrFail($id);
        $validateData = $request->validate([
            'nama' => 'required|unique:jabatans,nama',
            'deskripsi' => 'nullable'
        ]);
        if ($jabatan) {
            $jabatan->update([
                'nama'=>$validateData['nama'],
                'deskripsi'=>$validateData['deskripsi'],
            ]);
            $jabatan->save();
            return redirect()->route('jabatanlist')->with('success', $jabatan->nama.' telah berhasil diupdate');
        }
        return redirect()->route('jabatanlist')->with('error', 'data tidak ditemukan');
    
    }
    public function buatjabatan(Request $request) {
        $validateData = $request->validate([
            'nama' => 'required|unique:jabatans,nama',
            'deskripsi' => 'nullable'
        ]);
        $jabatan = new Jabatan();
        $jabatan->nama = $validateData['nama'];
        $jabatan->deskripsi = $validateData['deskripsi'];
        $jabatan->save();

        return redirect()->route('jabatanlist')->with('success', $validateData['nama'].' berhasil ditambah');
    }
    // DIVISIIII
    public function divisilist() {
        $divisi = Divisi::all();
        $data = [
            'divisi' => $divisi,
        ];
        return view('admin.IT.divisi',$data);
    }
    public function deletedivisi(Request $request, $id) {
        $divisi = Divisi::findOrFail($id);
        if($divisi){
            $divisi->delete();
            return redirect()->route('divisilist')->with('success', $divisi->nama.' telah dihapus');
        }
        return redirect()->route('divisilist')->with('error', 'item tidak ditemukan');
        
    }
    public function editdivisi(Request $request, $id) {
        $divisi = Divisi::findOrFail($id);
        $validateData = $request->validate([
            'nama' => 'required|unique:divisis,nama',
            'deskripsi' => 'nullable'
        ]);
        if ($divisi) {
            $divisi->update([
                'nama'=>$validateData['nama'],
                'deskripsi'=>$validateData['deskripsi'],
            ]);
            $divisi->save();
            return redirect()->route('divisilist')->with('success', $divisi->nama.' telah berhasil diupdate');
        }
        return redirect()->route('divisilist')->with('error', 'data tidak ditemukan');
    
    }
    public function buatdivisi(Request $request) {
        $validateData = $request->validate([
            'nama' => 'required|unique:divisis,nama',
            'deskripsi' => 'nullable'
        ]);
        $divisi = new Divisi();
        $divisi->nama = $validateData['nama'];
        $divisi->deskripsi = $validateData['deskripsi'];
        $divisi->save();

        return redirect()->route('divisilist')->with('success', $validateData['nama'].' berhasil ditambah');
    }
    # USERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
    public function userlist() {
        $user = User::all();
        $divisi = Divisi::all();

        $data = [
            'user' => $user,
            'divisi' => $divisi,
        ];
        return view('admin.IT.user',$data);
    }
    public function edituser(Request $request, $nik) {
        // dd($request);
        $user = User::where(['nik'=>$nik])->first();
        $validateData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'password' => 'nullable',
        ]);
        if ($user) {
            if ($validateData['password'] == '') {
                $user->update([
                    'nik'=>$validateData['nik'],
                    'nama'=>$validateData['nama'],
                    'email'=>$validateData['email'],
                    'password'=>$user->password,
                ]);
            }else{
                $user->update([
                    'nik'=>$validateData['nik'],
                    'nama'=>$validateData['nama'],
                    'email'=>$validateData['email'],
                    'password'=>bcrypt($validateData['password']),
                ]);
            }
            $user->save();
            return redirect()->route('userlist')->with('success', $user->nama.' telah berhasil diupdate');
        }
        return redirect()->route('userlist')->with('error', 'data tidak ditemukan');
    
    }
    public function deleteuser(Request $request, $nik) {
        $user = User::where(['nik'=>$nik])->first();
        if($user){
            $user->delete();
            return redirect()->route('userlist')->with('success', $user->nama.' telah dihapus');
        }
        return redirect()->route('userlist')->with('error', 'item tidak ditemukan');
        
    }
}
