<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <span class="brand-text font-weight-light ml-2">{{ auth()->user()->role === 'kasir' ? 'Kasir' : 'Admin' }}</span>
  </a>

  <div class="sidebar-user">
    <div class="avatar">
      <i class="fas fa-user-circle"></i>
    </div>
    <span class="name">{{ auth()->user()->name }}</span>
    <span class="role">{{ auth()->user()->role === 'kasir' ? 'Kasir' : 'Administrator' }}</span>
  </div>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        @php($path = request()->path())
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link {{ $path === 'admin/dashboard' || $path === '/' ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>

        @if(auth()->user()->role !== 'kasir')
        <li class="nav-item"><a href="{{ route('admin.user.index') }}" class="nav-link {{ str_starts_with($path,'admin/user') ? 'active' : '' }}"><i class="nav-icon fas fa-users"></i><p>User</p></a></li>
        <li class="nav-item"><a href="{{ route('admin.kategori.index') }}" class="nav-link {{ str_starts_with($path,'admin/kategori') ? 'active' : '' }}"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
        <li class="nav-item"><a href="{{ route('admin.produk.index') }}" class="nav-link {{ str_starts_with($path,'admin/produk') ? 'active' : '' }}"><i class="nav-icon fas fa-box"></i><p>Produk</p></a></li>
        @endif

        <li class="nav-item"><a href="{{ route('admin.transaksi.index') }}" class="nav-link {{ str_starts_with($path,'admin/transaksi') ? 'active' : '' }}"><i class="nav-icon fas fa-cash-register"></i><p>Transaksi</p></a></li>
      </ul>
    </nav>
  </div>
</aside> 
