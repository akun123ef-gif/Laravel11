<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Administrator', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        $kasir = User::updateOrCreate(
            ['email' => 'kasir@gmail.com'],
            ['name' => 'Kasir', 'password' => Hash::make('kasir123'), 'role' => 'kasir']
        );

        $makanan = Kategori::firstOrCreate(['name' => 'Makanan']);
        $minuman = Kategori::firstOrCreate(['name' => 'Minuman']);

        Produk::firstOrCreate(
            ['name' => 'Air Mineral'],
            ['kategori_id' => $minuman->id, 'harga' => 5000, 'stok' => 50]
        );
        Produk::firstOrCreate(
            ['name' => 'Mie Instan'],
            ['kategori_id' => $makanan->id, 'harga' => 3500, 'stok' => 50]
        );
    }
}
