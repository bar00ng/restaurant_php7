<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;

class MenuController extends Controller
{
    public function index() {
        $pageName = "Menu";

        $menu = Menu::get();

        return view('user.menu.list', compact('pageName', 'menu'));
    }

    public function formAdd() {
        $pageName = "Tambah Menu";
        $kategori = Kategori::get();

        return view('user.menu.formAdd', compact('pageName', 'kategori'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga_menu' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori,id',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.' ,
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'exists' => 'Kolom :attribute tidak valid.',
            'min' => 'Kolom :attribute tidak boleh kurang dari :min.',
        ]);

        Menu::create($validated);

        return redirect('/list-menu')->with('success', 'Berhasil menambahkan menu baru!');
    }

    public function formEdit($menu_id) {
        $pageName = "Edit Menu";
        $menu = Menu::where('id', $menu_id)
                    ->first();
        $kategori = Kategori::get();

        return view('user.menu.formEdit', compact('menu', 'pageName', 'kategori'));
    }

    public function patch(Request $request, $menu_id) {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga_menu' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori,id', 
            'inStock' => 'required|boolean'
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.' ,
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'min' => 'Kolom :attribute tidak boleh kurang dari :min.',
            'exists' => 'Kolom :attribute tidak valid.',
            'boolean' => 'Kolom :attribute harus berupa benar atau salah (true/false).'
        ]);

        Menu::where('id', $menu_id)
                ->update($validated);

        return redirect('/list-menu')->with('success', 'Berhasil mengubah menu!');
    }

    public function delete($menu_id) {
        Menu::find($menu_id)
                ->delete();
        
        return redirect('/list-menu')->with('success', 'Berhasil menghapus menu!');
        
    }
}
