<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index() {
        $pageName = "Kategori";

        $kategori = Kategori::get();

        return view('user.kategori.list', compact('pageName', 'kategori'));
    }

    public function formAdd() {
        $pageName = "Tambah Kategori";

        return view('user.kategori.formAdd', compact('pageName'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_kategori' => 'required|min:3|string'
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'min' => ':Attribute harus memiliki minimal :min karakter.',
            'unique' => ':Attribute sudah ada. Harap ganti'
        ]);

        Kategori::create($validated);

        return redirect('/list-kategori')->with('success', 'Berhasil menambahkan kategori baru!');
    }

    public function formEdit($kategori_id) {
        $pageName = "Edit Kategori";
        $kategori = Kategori::where('id', $kategori_id)
                    ->first();

        return view('user.kategori.formEdit', compact('kategori', 'pageName'));
    }

    public function patch(Request $request, $kategori_id) {
        $validated = $request->validate([
            'nama_kategori' => 'required|min:3|regex:/^[A-Za-z\s]+$/u'
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'min' => ':Attribute harus memiliki minimal :min karakter.',
            'regex' => ':Attribute hanya boleh terdiri dari huruf'
        ]);

        Kategori::where('id', $kategori_id)
                ->update($validated);

        return redirect('/list-kategori')->with('success', 'Berhasil mengubah kategori!');
    }

    public function delete($kategori_id) {
        Kategori::find($kategori_id)
                ->delete();
        
        return redirect('/list-kategori')->with('success', 'Berhasil menghapus kategori!');
        
    }
}
