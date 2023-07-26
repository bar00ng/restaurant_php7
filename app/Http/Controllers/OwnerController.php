<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class OwnerController extends Controller
{
    public function index() {
        $pageName = "Owner";

        $data = User::whereRoleIs('owner')
                    ->get();

        return view('user.owner.list', compact('pageName', 'data'));
    }

    public function formAdd() {
        $pageName = "Tambah Owner";

        return view('user.owner.formAdd', compact('pageName'));
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
        
        $user->attachRole('owner');

        return redirect('/list-owner')->with('success', 'Berhasil menambahkan owner baru!');
    }

    public function formEdit($user_id) {
        $pageName = "Edit Owner";
        $data = User::find($user_id);

        return view('user.owner.formEdit', compact('pageName', 'data'));
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

        return redirect('/list-owner')->with('success', 'Berhasil mengubah  owner!');
    }

    public function delete($user_id) {
        User::find($user_id)
                ->delete();
        
        return redirect('/list-owner')->with('success', 'Berhasil menghapus owner!');
        
    }
}
