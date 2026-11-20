<div class="row">
  <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3>{{ $stats['produk'] }}</h3><p>Total Produk</p></div><div class="icon"><i class="fas fa-box"></i></div></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3>{{ $stats['stok'] }}</h3><p>Total Stok Tersedia</p></div><div class="icon"><i class="fas fa-cubes"></i></div></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3>{{ $stats['transaksi'] }}</h3><p>Transaksi Selesai</p></div><div class="icon"><i class="fas fa-shopping-cart"></i></div></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-primary"><div class="inner"><h3>Rp {{ number_format($stats['omzet'],0,',','.') }}</h3><p>Total Omzet</p></div><div class="icon"><i class="fas fa-money-bill-wave"></i></div></div></div>
</div>

<div class="welcome-card">
  <h4><i class="fas fa-handshake mr-2"></i>Selamat Datang, <b>{{ auth()->user()->name }}</b>!</h4>
  <p class="mb-0">Anda login sebagai <strong>{{ auth()->user()->role === 'kasir' ? 'Kasir' : 'Administrator' }}</strong>. Gunakan menu di samping untuk mengelola transaksi, produk, dan lainnya.</p>
</div>

<div class="row">
  <div class="col-lg-6 col-md-12">
    <div class="card">
      <div class="card-header"><i class="fas fa-info-circle mr-2"></i>Panduan Singkat</div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li><i class="fas fa-check text-success mr-2"></i> Kelola <strong>Produk</strong> — tambah, edit, dan hapus produk</li>
          <li><i class="fas fa-check text-success mr-2"></i> Kelola <strong>Kategori</strong> — klasifikasikan produk Anda</li>
          <li><i class="fas fa-check text-success mr-2"></i> Buat <strong>Transaksi</strong> — catat penjualan dan hitung kembalian</li>
          @if(auth()->user()->role !== 'kasir')
          <li><i class="fas fa-check text-success mr-2"></i> Kelola <strong>User</strong> — atur akun admin dan kasir</li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-12">
    <div class="card">
      <div class="card-header"><i class="fas fa-chart-pie mr-2"></i>Statistik Singkat</div>
      <div class="card-body text-center">
        <div class="row text-center">
          <div class="col-4"><div class="text-danger"><i class="fas fa-box-open fa-2x mb-2"></i><div class="h5 font-weight-bold">{{ $stats['produk'] }}</div><small class="text-muted">Produk</small></div></div>
          <div class="col-4"><div class="text-success"><i class="fas fa-shopping-cart fa-2x mb-2"></i><div class="h5 font-weight-bold">{{ $stats['transaksi'] }}</div><small class="text-muted">Transaksi</small></div></div>
          <div class="col-4"><div class="text-primary"><i class="fas fa-money-bill-wave fa-2x mb-2"></i><div class="h5 font-weight-bold">Rp {{ number_format($stats['omzet'],0,',','.') }}</div><small class="text-muted">Omzet</small></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
