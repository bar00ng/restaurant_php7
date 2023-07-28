<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Payment;
use App\Models\Menu;
use App\Models\Kategori;
use Auth;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function index() {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $today = Carbon::today()->toDateString();
        $limaBulan = Carbon::today()->subMonths(5)->startOfMonth();

        $pageName = "Dashboard";

        $payment_all = Payment::get();
        $payment_harian = Payment::whereDate('created_at', $today)->get();
        $payment_bulanan = Payment::whereMonth('created_at', $currentMonth)
                                    ->whereYear('created_at', $currentYear)
                                    ->get();
        $payment_lima_bulan = Payment::whereDate('created_at', '>=', $limaBulan)
                                    ->get();

        $total_pendapatan_harian = 0;
        $total_pendapatan_bulan = 0;
        $menuCategories = [];
        $menuCategoryCounts = [];
        $totalPendapatanBulanan = [];

        // Menghitung Total Pendapatan Hari Ini
        foreach($payment_harian as $payment) {
            foreach($payment->pesanan->detailPesanan as $detail) {
                $total_pendapatan_harian += ($detail->menu->harga_jual_menu - $detail->menu->harga_modal_menu);
            }
        }

        // Menghitung Total Pendapatan Bulan Ini
        foreach($payment_bulanan as $payment) {
            foreach($payment->pesanan->detailPesanan as $i) {
                $total_pendapatan_bulan += ($i->menu->harga_jual_menu - $i->menu->harga_modal_menu);
            }
        }

        // Menyiapkan data untuk PieChart (Penjualan per kategori)
        foreach ($payment_all as $payment) {
            foreach ($payment->pesanan->detailPesanan as $detail) {
                $menuCategory = $detail->menu->kategori->nama_kategori;
        
                if (array_key_exists($menuCategory, $menuCategories)) {
                    $menuCategoryCounts[$menuCategory]++;
                } else {
                    $menuCategories[$menuCategory] = $menuCategory;
                    $menuCategoryCounts[$menuCategory] = 1;
                    $backgroundColor[] = $this->random_color();
                }
            }
        }

        // Menyiapkan data untuk BarChart (Penjualan per bulan)
        foreach ($payment_lima_bulan as $payment) {
            foreach ($payment->pesanan->detailPesanan as $detail) {
                // Ambil bulan dari tanggal pembayaran (created_at) menggunakan Carbon
                $bulan = \Carbon\Carbon::parse($payment->created_at)->format('F Y');
        
                // Hitung pendapatan per item dan tambahkan ke total pendapatan bulanan
                $pendapatanPerItem = $detail->menu->harga_jual_menu - $detail->menu->harga_modal_menu;
        
                // Jika bulan sudah ada dalam array, tambahkan pendapatan ke bulan tersebut
                if (isset($totalPendapatanBulanan[$bulan])) {
                    $totalPendapatanBulanan[$bulan] += $pendapatanPerItem;
                } else {
                    // Jika bulan belum ada dalam array, tambahkan bulan dan pendapatannya
                    $totalPendapatanBulanan[$bulan] = $pendapatanPerItem;
                }
            }
        }
        // Dapatkan list bulan dan total pendapatan dari associative array yang sudah terisi
        $listBulan = array_keys($totalPendapatanBulanan);
        $totalPendapatanList = array_values($totalPendapatanBulanan);
        $maxTotalPendapatan = max($totalPendapatanList);

        $pesanan_tertunda = Pesanan::where('status', 'Belum Selesai')->count();
        $total_pesanan = Pesanan::count();

        // dd($listBulan, $totalPendapatanList);

        if (Auth::user()->hasRole('kasir')) {
            return redirect('/tambah-pesanan');
        } else {    
            return view('user.dashboard', compact(
                'pageName',
                'pesanan_tertunda',
                'total_pesanan',
                'total_pendapatan_harian',
                'total_pendapatan_bulan',
                'menuCategories',
                'menuCategoryCounts',
                'listBulan',
                'totalPendapatanList',
                'maxTotalPendapatan',
                'backgroundColor'
            ));
        }
    }
}
