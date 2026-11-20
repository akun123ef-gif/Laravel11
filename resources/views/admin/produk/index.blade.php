<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-box mr-2"></i>{{ $title }}</h5>
      <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Tambah Produk</a>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr><th>No</th><th>Gambar</th><th>Produk</th><th>Kategori</th><th class="currency">Harga</th><th class="currency">Stok</th><th width="160" class="text-center">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($produk as $item)
          <tr>
            <td>{{ $produk->firstItem()+$loop->index }}</td>
            <td>@if($item->gambar)<img src="/{{ $item->gambar }}" class="product-thumb">@else <span class="text-muted">-</span>@endif</td>
            <td><strong>{{ $item->name }}</strong></td>
            <td>{{ $item->kategori->name }}</td>
            <td class="currency">Rp {{ number_format($item->harga,0,',','.') }}</td>
            <td class="currency"><span class="badge badge-{{ $item->stok > 0 ? 'success':'danger' }}">{{ $item->stok }}</span></td>
            <td class="text-center">
              <a href="{{ route('admin.produk.edit',$item) }}" class="btn btn-info btn-sm mr-1"><i class="fas fa-edit"></i></a>
              <form action="{{ route('admin.produk.destroy',$item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center py-4 text-muted"><i class="fas fa-box-open fa-3x mb-3"></i><br>Belum ada produk.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
    {{ $produk->links() }}
  </div>
</div>
