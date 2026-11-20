<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminKategoriController extends Controller
{
    public function index()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Manajemen Kategori',
            'kategori' => Kategori::latest()->paginate(10),
            'content' => 'admin.kategori.index',
        ]);
    }

    public function create()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Tambah Kategori',
            'content' => 'admin.kategori.create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100|unique:kategoris,name']);
        Kategori::create($data);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Edit Kategori',
            'kategori' => $kategori,
            'content' => 'admin.kategori.create',
        ]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('kategoris', 'name')->ignore($kategori->id)],
        ]);
        $kategori->update($data);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->produk()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
