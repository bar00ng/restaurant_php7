<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Payment;
use App\Models\Menu;
use App\Models\Kategori;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $today = Carbon::today()->toDateString();

        $pageName = "Dashboard";

        $pesanan_tertunda = Pesanan::where('status', 'Belum Selesai')->count();

        
        return view('user.dashboard', compact(
            'pageName',
            'pesanan_tertunda'
        ));
    }
}
