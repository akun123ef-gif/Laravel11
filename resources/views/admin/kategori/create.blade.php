<div class="card col-lg-7">
  <div class="card-header">
    <h5 class="mb-0"><i class="fas fa-tags mr-2"></i>{{ $title }}</h5>
  </div>
  <div class="card-body">
    <form action="{{ isset($kategori) ? route('admin.kategori.update',$kategori) : route('admin.kategori.store') }}" method="POST">@csrf
      @if(isset($kategori)) @method('PUT') @endif
      <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $kategori->name ?? '') }}" required placeholder="Masukkan nama kategori">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mt-4">
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </form>
  </div>
</div>
