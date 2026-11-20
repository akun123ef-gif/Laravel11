<div class="row">
<div class="col-lg-6"><div class="card">
  <div class="card-header">
    <h5 class="mb-0"><i class="fas fa-plus-circle mr-2"></i>Tambah Produk — Transaksi #{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</h5>
  </div>
  <div class="card-body">
    <form method="GET" action="{{ route('admin.transaksi.edit',$transaksi) }}">
      <label>Pilih Produk</label>
      <div class="input-group">
        <select name="produk_id" class="form-control" required>
          <option value="">-- pilih produk --</option>
          @foreach($produk as $item)
            <option value="{{ $item->id }}" @selected(request('produk_id')==$item->id)>{{ $item->name }} — Rp {{ number_format($item->harga,0,',','.') }} (stok {{ $item->stok }})</option>
          @endforeach
        </select>
        <div class="input-group-append"><button class="btn btn-primary">Pilih</button></div>
      </div>
    </form>
    @if($p_detail)
    <hr>
    <form method="POST" action="{{ route('admin.transaksi.detail.store') }}">@csrf
      <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
      <input type="hidden" name="produk_id" value="{{ $p_detail->id }}">
      <div class="form-group">
        <label>Nama Produk</label>
        <input class="form-control" value="{{ $p_detail->name }}" disabled>
      </div>
      <div class="form-group">
        <label>Harga Satuan</label>
        <input class="form-control" value="Rp {{ number_format($p_detail->harga,0,',','.') }}" disabled>
      </div>
      <div class="form-group">
        <label>Qty</label>
        <input type="number" min="1" max="{{ $p_detail->stok }}" name="qty" class="form-control" value="{{ min($qty,$p_detail->stok) }}" required>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-cart-plus mr-1"></i>Tambah ke Transaksi</button>
    </form>
    @endif
  </div>
</div></div>
<div class="col-lg-6"><div class="card">
  <div class="card-header">
    <h5 class="mb-0"><i class="fas fa-shopping-cart mr-2"></i>Detail Belanja</h5>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr><th>Produk</th><th class="currency">Qty</th><th class="currency">Subtotal</th><th width="80" class="text-center"></th></tr>
        </thead>
        <tbody>
        @forelse($transaksi_detail as $item)
          <tr>
            <td>{{ $item->produk_name }}</td>
            <td class="currency">{{ $item->qty }}</td>
            <td class="currency">Rp {{ number_format($item->subtotal,0,',','.') }}</td>
            <td class="text-center">
              <form method="POST" action="{{ route('admin.transaksi.detail.destroy',[$transaksi,$item]) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center py-4 text-muted"><i class="fas fa-box fa-3x mb-3"></i><br>Belum ada item.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer bg-white">
    <div class="d-flex justify-content-between mb-3">
      <span class="h5"><b>Total</b></span>
      <span class="h4 text-primary"><strong>Rp {{ number_format($transaksi->total,0,',','.') }}</strong></span>
    </div>
    <form method="POST" action="{{ route('admin.transaksi.finish',$transaksi) }}">@csrf
      <div class="form-group">
        <label>Uang Dibayarkan</label>
        <input type="number" name="dibayarkan" min="{{ $transaksi->total }}" class="form-control" value="{{ $dibayarkan }}" required>
      </div>
      <div class="mb-3">
        <label class="font-weight-bold">Kembalian:</label>
        <span class="h5 text-success">Rp {{ number_format($kembalian,0,',','.') }}</span>
      </div>
      <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
      @if($transaksi->total > 0)
        <button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i>Selesaikan Transaksi</button>
      @endif
    </form>
  </div>
</div></div>
