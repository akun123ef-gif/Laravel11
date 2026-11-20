<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kasir_name', 'total', 'dibayarkan', 'kembalian', 'status'];

    protected $casts = [
        'total' => 'integer',
        'dibayarkan' => 'integer',
        'kembalian' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
