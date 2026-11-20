<div class="card"><div class="card-body">
<div class="d-flex justify-content-between align-items-center"><h5 class="mb-0"><i class="fas fa-cash-register mr-2"></i>{{ $title }}</h5>
      <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Transaksi Baru</a></div>
<div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>No</th><th>Nota</th><th>Kasir</th><th class="currency">Total</th><th class="text-center">Status</th><th>Tanggal</th><th width="180" class="text-center">Aksi</th></tr></thead><tbody>
@forelse($transaksi as $item)<tr><td>{{ $transaksi->firstItem()+$loop->index }}</td><td>#{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td><td>{{ $item->kasir_name }}</td><td class="currency"><strong>Rp {{ number_format($item->total,0,',','.') }}</strong></td><td class="text-center"><span class="badge badge-{{ $item->status==='completed'?'success':'warning' }}">{{ ucfirst($item->status) }}</span></td><td>{{ $item->created_at->format('d/m/Y H:i') }}</td><td class="text-center">
  <div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('admin.transaksi.edit',$item) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
    @if($item->status==='completed')
      <a href="{{ route('admin.transaksi.struk',$item->id) }}" target="_blank" class="btn btn-success" title="Cetak Struk"><i class="fas fa-print"></i></a>
    @endif
    <form action="{{ route('admin.transaksi.destroy',$item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi ini dan kembalikan stok?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button></form>
  </div>
</td></tr>
@empty<tr><td colspan="7" class="text-center py-4 text-muted"><i class="fas fa-receipt fa-3x mb-3"></i><br>Belum ada transaksi.</td></tr>@endforelse</tbody></table></div>{{ $transaksi->links() }}
</div></div>