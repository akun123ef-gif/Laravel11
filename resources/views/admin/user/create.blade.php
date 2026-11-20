<div class="card col-lg-7">
  <div class="card-header">
    <h5 class="mb-0"><i class="fas fa-user-plus mr-2"></i>{{ $title }}</h5>
  </div>
  <div class="card-body">
    <form action="{{ isset($user) ? route('admin.user.update',$user) : route('admin.user.store') }}" method="POST">@csrf @if(isset($user)) @method('PUT') @endif
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name ?? '') }}" required placeholder="Masukkan nama lengkap">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email ?? '') }}" required placeholder="email@example.com">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
          <option value="admin" {{ old('role', $user->role ?? 'admin') == 'admin' ? 'selected' : '' }}>Administrator</option>
          <option value="kasir" {{ old('role', $user->role ?? 'admin') == 'kasir' ? 'selected' : '' }}>Kasir</option>
        </select>
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Password @isset($user)<small class="text-muted">(kosongkan jika tidak diubah)</small>@endisset</label>
        <input type="password" name="password" class="form-control" @empty($user) required @endempty placeholder="••••••••">
      </div>
      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="re_password" class="form-control" placeholder="••••••••">
      </div>
      <div class="mt-4">
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </form>
  </div>
</div>
