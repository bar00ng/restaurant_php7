<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class KasirController extends Controller
{
    public function index() {
        $pageName = "Kasir";

        $data = User::whereRoleIs('kasir')
                    ->get();

        return view('user.kasir.list', compact('pageName', 'data'));
    }

    public function formAdd() {
        $pageName = "Tambah Kasir";

        return view('user.kasir.formAdd', compact('pageName'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|min:3|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.min' => 'Kolom nama minimal harus memiliki :min karakter.',
            'name.string' => 'Kolom nama harus berupa teks.',

            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar dalam sistem.',

            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Kolom password minimal harus memiliki :min karakter.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        
        $user->attachRole('kasir');

        return redirect('/list-kasir')->with('success', 'Berhasil menambahkan kasir baru!');
    }

    public function formEdit($user_id) {
        $pageName = "Edit Kasir";
        $data = User::find($user_id);

        return view('user.kasir.formEdit', compact('pageName', 'data'));
    }

    public function patch(Request $request, $user_id) {
        $validated = $request->validate([
            'name' => 'required|min:3|string',
            'email' => 'required|email',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.min' => 'Kolom nama minimal harus memiliki :min karakter.',
            'name.string' => 'Kolom nama harus berupa teks.',

            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        User::where('id', $user_id)
                ->update($validated);

        return redirect('/list-kasir')->with('success', 'Berhasil mengubah  kasir!');
    }

    public function delete($user_id) {
        User::find($user_id)
                ->delete();
        
        return redirect('/list-kasir')->with('success', 'Berhasil menghapus kasir!');
        
    }
}
