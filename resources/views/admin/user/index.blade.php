<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-users mr-2"></i>{{ $title }}</h5>
      <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Tambah User</a>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead>
        <tr><th>No</th><th>Nama Lengkap</th><th>Email</th><th width="160" class="text-center">Aksi</th></tr>
      </thead>
      <tbody>
      @forelse($user as $item)
        <tr>
          <td>{{ $user->firstItem()+$loop->index }}</td>
          <td><strong>{{ $item->name }}</strong></td>
          <td>{{ $item->email }}</td>
          <td class="text-center">
            <a href="{{ route('admin.user.edit',$item) }}" class="btn btn-info btn-sm mr-1"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.user.destroy',$item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center py-4 text-muted"><i class="fas fa-users fa-3x mb-3"></i><br>Belum ada user.</td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $user->links() }}
  </div>
</div>
