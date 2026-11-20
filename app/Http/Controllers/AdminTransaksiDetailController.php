<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTransaksiDetailController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'transaksi_id' => ['required', 'exists:transaksis,id'],
            'produk_id' => ['required', 'exists:produks,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($data) {
            $transaksi = Transaksi::lockForUpdate()->findOrFail($data['transaksi_id']);
            if ($transaksi->status === 'completed') abort(422, 'Transaksi sudah selesai.');

            $produk = Produk::lockForUpdate()->findOrFail($data['produk_id']);
            $detail = $transaksi->details()->where('produk_id', $produk->id)->first();
            $oldQty = $detail?->qty ?? 0;
            $newQty = $oldQty + $data['qty'];
            $additional = $newQty - $oldQty;

            if ($additional > $produk->stok) {
                abort(422, 'Stok produk tidak mencukupi.');
            }

            if ($detail) {
                $detail->update([
                    'qty' => $newQty,
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $newQty * $produk->harga,
                ]);
            } else {
                $transaksi->details()->create([
                    'produk_id' => $produk->id,
                    'produk_name' => $produk->name,
                    'qty' => $data['qty'],
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $data['qty'] * $produk->harga,
                ]);
            }

            $produk->decrement('stok', $additional);
            $transaksi->update(['total' => $transaksi->details()->sum('subtotal')]);
        });

        return back()->with('success', 'Produk berhasil ditambahkan ke transaksi.');
    }

    public function destroy(Transaksi $transaksi, TransaksiDetail $detail)
    {
        abort_unless($detail->transaksi_id === $transaksi->id, 404);

        DB::transaction(function () use ($transaksi, $detail) {
            if ($detail->produk) $detail->produk->increment('stok', $detail->qty);
            $detail->delete();
            $transaksi->update(['total' => $transaksi->details()->sum('subtotal')]);
        });

        return back()->with('success', 'Detail transaksi dihapus.');
    }
}
