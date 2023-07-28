<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index($kd_pesanan) {
        $pageName = "Checkout";
        $data = Pesanan::where('kd_pesanan', $kd_pesanan)->first();
        $data_detail = PesananDetail::where('kd_pesanan', $kd_pesanan)->get();

        // dd($data, $data_detail);
        return view('user.pesanan.payment', compact('data', 'data_detail', 'pageName'));
    }

    public function store(Request $request, $kd_pesanan) {
        $validated = $request->validate([
            'kembalian_payment' => 'required|numeric|min:0',
            'nominal_payment' => 'required|numeric|min:0',
        ], [
            'kembalian_payment.required' => 'Kembalian harus diisi.',
            'kembalian_payment.numeric' => 'Kembalian harus berupa angka.',
            'kembalian_payment.min' => 'Kembalian harus minimal :min.',
            'nominal_payment.required' => 'Nominal pembayaran harus diisi.',
            'nominal_payment.numeric' => 'Nominal pembayaran harus berupa angka.',
            'nominal_payment.min' => 'Nominal pembayaran harus minimal :min.',    
        ]);

        Payment::create([
            'kd_pesanan' => $kd_pesanan,
            'nominal_payment' => $validated['nominal_payment'],
            'kembalian_payment' => $validated['kembalian_payment']
        ]);

        Pesanan::where('kd_pesanan', $kd_pesanan)->update([
            'status' => 'Selesai'
        ]);

        return redirect('/pesanan-selesai')->with('success', 'Payment berhasil!');
    }
}
