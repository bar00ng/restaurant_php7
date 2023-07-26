<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;

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

Route::group(['middleware' => ['auth', 'role:superadmin']], function() {
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
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('redirectIfAuthenticated')->group(function (){
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});
