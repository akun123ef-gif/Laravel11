<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Manajemen Transaksi',
            'transaksi' => Transaksi::with('details')->latest()->paginate(10),
            'content' => 'admin.transaksi.index',
        ]);
    }

    public function create()
    {
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'kasir_name' => auth()->user()->name,
            'total' => 0,
            'dibayarkan' => 0,
            'kembalian' => 0,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.transaksi.edit', $transaksi);
    }

    public function edit(Transaksi $transaksi)
    {
        $produk = Produk::with('kategori')->where('stok', '>', 0)->orderBy('name')->get();
        $produkId = request('produk_id');
        $pDetail = $produkId ? Produk::find($produkId) : null;
        $qty = max(1, (int) request('qty', 1));
        $subtotal = $pDetail ? $qty * $pDetail->harga : 0;
        $dibayarkan = max(0, (int) request('dibayarkan', $transaksi->dibayarkan));
        $kembalian = max(0, $dibayarkan - $transaksi->total);

        return view('admin.layouts.wrapper', [
            'title' => 'Tambah Transaksi',
            'produk' => $produk,
            'p_detail' => $pDetail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'transaksi_detail' => $transaksi->details()->latest()->get(),
            'transaksi' => $transaksi,
            'dibayarkan' => $dibayarkan,
            'kembalian' => $kembalian,
            'content' => 'admin.transaksi.create',
        ]);
    }

    public function finish(Request $request, Transaksi $transaksi)
    {
        if ($transaksi->status === 'completed') {
            return redirect()->route('admin.transaksi.struk', $transaksi->id);
        }

        $data = $request->validate(['dibayarkan' => ['required', 'integer', 'min:0']]);
        if ($data['dibayarkan'] < $transaksi->total) {
            return back()->with('error', 'Uang pembayaran masih kurang.');
        }

        $transaksi->update([
            'dibayarkan' => $data['dibayarkan'],
            'kembalian' => $data['dibayarkan'] - $transaksi->total,
            'status' => 'completed',
        ]);

        return redirect()->route('admin.transaksi.struk', $transaksi->id)
                         ->with('success', 'Transaksi berhasil diselesaikan.');
    }

    public function struk(Transaksi $transaksi)
    {
        $transaksi->load('details.produk');

        return view('admin.transaksi.struk', compact('transaksi'));
    }

    public function pending(Transaksi $transaksi)
    {
        $transaksi->update(['status' => 'pending']);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi disimpan sebagai pending.');
    }

    public function destroy(Transaksi $transaksi)
    {
        DB::transaction(function () use ($transaksi) {
            foreach ($transaksi->details as $detail) {
                if ($detail->produk) $detail->produk->increment('stok', $detail->qty);
            }
            $transaksi->details()->delete();
            $transaksi->delete();
        });

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}