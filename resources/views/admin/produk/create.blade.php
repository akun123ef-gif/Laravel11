<div class="card col-lg-7">
  <div class="card-header">
    <h5 class="mb-0"><i class="fas fa-box mr-2"></i>{{ $title }}</h5>
  </div>
  <div class="card-body">
    <form action="{{ isset($produk) ? route('admin.produk.update',$produk) : route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">@csrf @if(isset($produk)) @method('PUT') @endif
      <div class="form-group">
        <label>Nama Produk</label>
        <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$produk->name ?? '') }}" required placeholder="Masukkan nama produk">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
          <option value="">-- pilih kategori --</option>
          @foreach($kategori as $item)
            <option value="{{ $item->id }}" @selected(old('kategori_id',$produk->kategori_id ?? '')==$item->id)>{{ $item->name }}</option>
          @endforeach
        </select>
        @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Harga</label>
        <input type="number" min="0" name="harga" class="form-control" value="{{ old('harga',$produk->harga ?? 0) }}" required placeholder="0">
      </div>
      <div class="form-group">
        <label>Stok</label>
        <input type="number" min="0" name="stok" class="form-control" value="{{ old('stok',$produk->stok ?? 0) }}" required placeholder="0">
      </div>
      <div class="form-group">
        <label>Gambar Produk</label>
        <input type="file" name="gambar" class="form-control-file">
        @if(isset($produk) && $produk->gambar)
          <div class="mt-3"><img src="/{{ $produk->gambar }}" class="product-thumb" alt="Produk"></div>
        @endif
      </div>
      <div class="mt-4">
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </form>
  </div>
</div>
