<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\AdminUserController;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->name('login.do');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/admin/dashboard', function () {
        return view('admin.layouts.wrapper', [
            'title' => 'Dashboard',
            'content' => 'admin.dashboard.index',
            'stats' => [
                'users' => User::count(),
                'kategori' => Kategori::count(),
                'produk' => Produk::count(),
                'stok' => (int) Produk::sum('stok'),
                'transaksi' => Transaksi::where('status', 'completed')->count(),
                'omzet' => (int) Transaksi::where('status', 'completed')->sum('total'),
            ],
        ]);
    })->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        // Diblokir jika role adalah 'kasir'
        Route::middleware('kasir.block')->group(function () {
            Route::resource('user', AdminUserController::class)->except(['show']);
            Route::resource('kategori', AdminKategoriController::class)->except(['show']);
            Route::resource('produk', AdminProdukController::class)->except(['show']);
        });

        // Bisa diakses semua role terautentikasi (termasuk kasir)
        Route::resource('transaksi', AdminTransaksiController::class)->only(['index', 'create', 'edit', 'destroy']);
        Route::post('transaksi/detail', [AdminTransaksiDetailController::class, 'store'])->name('transaksi.detail.store');
        Route::delete('transaksi/{transaksi}/detail/{detail}', [AdminTransaksiDetailController::class, 'destroy'])->name('transaksi.detail.destroy');
        Route::post('transaksi/{transaksi}/finish', [AdminTransaksiController::class, 'finish'])->name('transaksi.finish');
        Route::post('transaksi/{transaksi}/pending', [AdminTransaksiController::class, 'pending'])->name('transaksi.pending');
        Route::get('transaksi/{transaksi}/struk', [AdminTransaksiController::class, 'struk'])->name('transaksi.struk');
    });
});