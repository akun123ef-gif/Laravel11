<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link"><i class="fas fa-bell"></i></a></li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user mr-1"></i>{{ auth()->user()->name }}
        <span class="user-badge">{{ auth()->user()->role === 'kasir' ? 'Kasir' : 'Admin' }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Profile</a>
        <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Pengaturan</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt mr-2"></i>Keluar</a>
      </div>
    </li>
  </ul>
</nav>
