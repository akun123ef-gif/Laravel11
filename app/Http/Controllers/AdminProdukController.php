<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AdminProdukController extends Controller
{
    public function index()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Manajemen Produk',
            'produk' => Produk::with('kategori')->latest()->paginate(10),
            'content' => 'admin.produk.index',
        ]);
    }

    public function create()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Tambah Produk',
            'kategori' => Kategori::orderBy('name')->get(),
            'content' => 'admin.produk.create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['gambar'] = $this->storeImage($request);
        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Edit Produk',
            'produk' => $produk,
            'kategori' => Kategori::orderBy('name')->get(),
            'content' => 'admin.produk.create',
        ]);
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $this->validated($request, $produk);
        if ($request->hasFile('gambar')) {
            $this->deleteImage($produk->gambar);
            $data['gambar'] = $this->storeImage($request);
        } else {
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->transaksiDetail()->exists()) {
            return back()->with('error', 'Produk tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        $this->deleteImage($produk->gambar);
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request, ?Produk $produk = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150', Rule::unique('produks', 'name')->ignore($produk?->id)],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function storeImage(Request $request): ?string
    {
        if (!$request->hasFile('gambar')) return null;
        $dir = public_path('uploads/images');
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $file = $request->file('gambar');
        $name = uniqid('produk_', true).'.'.$file->getClientOriginalExtension();
        $file->move($dir, $name);
        return 'uploads/images/'.$name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            $full = public_path($path);
            if (File::exists($full)) File::delete($full);
        }
    }
}
