<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['auth', 'role:superadmin|owner']], function() {
    // Routes untuk kategori
    Route::get('/list-kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/tambah-kategori', [KategoriController::class, 'formAdd'])->name('kategori.form.add');
    Route::post('/tambah-kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/edit-kategori/{kategori_id}', [KategoriController::class, 'formEdit'])->name('kategori.form.edit');
    Route::patch('/edit-kategori/{kategori_id}', [KategoriController::class, 'patch'])->name('kategori.patch');
    Route::delete('/hapus-kategori/{kategori_id}', [KategoriController::class, 'delete'])->name('kategori.delete');

    // Routes untuk Menu
    Route::get('/list-menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/tambah-menu', [MenuController::class, 'formAdd'])->name('menu.form.add');
    Route::post('/tambah-menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/edit-menu/{menu_id}', [MenuController::class, 'formEdit'])->name('menu.form.edit');
    Route::patch('/edit-menu/{menu_id}', [MenuController::class, 'patch'])->name('menu.patch');
    Route::delete('/hapus-menu/{menu_id}', [MenuController::class, 'delete'])->name('menu.delete');

    // Routes untuk kasir
    Route::get('/list-kasir', [KasirController::class, 'index'])->name('kasir');
    Route::get('/tambah-kasir', [KasirController::class, 'formAdd'])->name('kasir.form.add');
    Route::post('/tambah-kasir', [KasirController::class, 'store'])->name('kasir.store');
    Route::get('/edit-kasir/{user_id}', [KasirController::class, 'formEdit'])->name('kasir.form.edit');
    Route::patch('/edit-kasir/{user_id}', [KasirController::class, 'patch'])->name('kasir.patch');
    Route::delete('/hapus-kasir/{user_id}', [KasirController::class, 'delete'])->name('kasir.delete');

    // Routes untuk owner
    Route::get('/list-owner', [OwnerController::class, 'index'])->name('owner');
    Route::get('/tambah-owner', [OwnerController::class, 'formAdd'])->name('owner.form.add');
    Route::post('/tambah-owner', [OwnerController::class, 'store'])->name('owner.store');
    Route::get('/edit-owner/{user_id}', [OwnerController::class, 'formEdit'])->name('owner.form.edit');
    Route::patch('/edit-owner/{user_id}', [OwnerController::class, 'patch'])->name('owner.patch');
    Route::delete('/hapus-owner/{user_id}', [OwnerController::class, 'delete'])->name('owner.delete');

    // Routes untuk generate pdf
    Route::get('/generate-pdf', [PesananController::class, 'generatePdf'])->name('generate.pdf');
});

Route::group(['middleware' => ['auth', 'role:superadmin|kasir|owner']], function() {
    Route::get('/pesanan-tertunda', [PesananController::class, 'getPesananTertunda'])->name('pesanan.tertunda');
    Route::get('/pesanan-selesai', [PesananController::class, 'getPesananSelesai'])->name('pesanan.selesai');
});

Route::group(['middleware' => ['auth', 'role:superadmin|kasir']], function() {
    // Routes untuk Pesanan
    Route::get('/tambah-pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/pesanan-checkout', [PesananController::class, 'formAdd'])->name('pesanan.form.add');
    Route::post('/pesanan-checkout', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan-payment/{kd_pesanan}', [PaymentController::class, 'index'])->name('pesanan.payment');
    Route::post('/pesanan-payment/{kd_pesanan}', [PaymentController::class, 'store'])->name('payment.store');

    // Routes untuk tambah barang ke cart
    Route::post('/add-to-cart/{menu_id}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/destroy-cart', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/remove-from-cart/{cart_item_id}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::group(['middleware' => ['auth', 'role:superadmin']], function() {
    Route::delete('/hapus-pesanan/{kd_pesanan}', [PesananController::class, 'delete'])->name('pesanan.delete');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('redirectIfAuthenticated')->group(function (){
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});
