<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kategori_id', 'harga', 'stok', 'gambar'];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
