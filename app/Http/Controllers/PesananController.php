<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Menu;

class PesananController extends Controller
{
    public function index() {
        $pageName = 'Tambah Pesanan';
        $inStockMenus = Menu::where('inStock', true)
                        ->get();

        return view('user.pesanan.list', compact('pageName', 'inStockMenus'));
    }

    public function formAdd() {
        $pageName = 'Bill Pesanan';

        return view('user.pesanan.formAdd', compact('pageName'));
    }

    public function store(Request $request) {
        $kd_pesanan = Pesanan::generateKodePesanan();

        $validate = $request->validate([
            'pemesan_pesanan' => 'required|string|max:255',
            'total_pesanan' => 'required|numeric|min:0'
        ], [
            'pemesan_pesanan.required' => 'Nama pemesan pesanan harus diisi.',
            'pemesan_pesanan.string' => 'Nama pemesan pesanan harus berupa teks.',
            'pemesan_pesanan.max' => 'Nama pemesan pesanan tidak boleh lebih dari :max karakter.',

            'total_pesanan.required' => 'Total pesanan harus diisi.',
            'total_pesanan.numeric' => 'Total pesanan harus berupa angka.',
            'total_pesanan.min' => 'Total pesanan harus lebih besar atau sama dengan :min.',
        ]);
        
        $validate['kd_pesanan'] = $kd_pesanan;
        $validate['user_id'] = Auth::user()->id;
        $validate['tanggal_pesanan'] = Carbon::now();

        $pesanan = Pesanan::create($validate);

        foreach (Cart::content() as $item) {
            PesananDetail::create([
                'kd_pesanan' => $kd_pesanan,
                'menu_id' => $item->id,
                'qty' => $item->qty,
                'sub_total' => $item->subtotal
            ]);
        }

        Cart::destroy();

        return redirect('/pesanan-tertunda')->with('success', 'Berhasil menambahkan pesanan baru!');
    }

    public function getPesananTertunda() {
        $pageName = 'List Pesanan Tertunda';
        $data = Pesanan::where('status', 'Belum Selesai')->orderByDesc('tanggal_pesanan')->get();
        
        return view('user.pesanan.listTertunda', compact('data', 'pageName'));
    }

    public function getPesananSelesai() {
        $pageName = 'List Pesanan Selesai';
        $data = Pesanan::where('status', 'Selesai')->orderByDesc('tanggal_pesanan')->get();
        
        return view('user.pesanan.listSelesai', compact('data', 'pageName'));
    }

    public function delete($kd_pesanan) {
        Pesanan::where('kd_pesanan', $kd_pesanan)->delete();

        return back()->with('success', 'Pesanan berhasil dihapus');
    }
}
