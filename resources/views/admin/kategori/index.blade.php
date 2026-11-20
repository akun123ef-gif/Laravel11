<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-tags mr-2"></i>{{ $title }}</h5>
      <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Tambah Kategori</a>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead>
        <tr><th>No</th><th>Nama Kategori</th><th width="160" class="text-center">Aksi</th></tr>
      </thead>
      <tbody>
      @forelse($kategori as $item)
        <tr>
          <td>{{ $kategori->firstItem()+$loop->index }}</td>
          <td>{{ $item->name }}</td>
          <td class="text-center">
            <a href="{{ route('admin.kategori.edit',$item) }}" class="btn btn-info btn-sm mr-1"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.kategori.destroy',$item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      @empty
        <tr><td colspan="3" class="text-center py-4 text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><br>Belum ada kategori.</td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $kategori->links() }}
  </div>
</div>
