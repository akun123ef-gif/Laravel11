<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Kasir Laravel' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/vendor/admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/vendor/admin/dist/css/adminlte.min.css">
  <style>
    :root{--primary-color:#2c3e50;--primary-gradient:linear-gradient(135deg,#2c3e50 0%,#4ca1af 100%);--success-gradient:linear-gradient(135deg,#2ecc71 0%,#27ae60 100%);--warning-gradient:linear-gradient(135deg,#f39c12 0%,#e67e22 100%);--info-gradient:linear-gradient(135deg,#3498db 0%,#2980b9 100%);--danger-gradient:linear-gradient(135deg,#e74c3c 0%,#c0392b 100%)}
    body{font-family:'Poppins',sans-serif!important}
    .brand-link{background:var(--primary-gradient)!important;padding:1rem 0.75rem!important;text-align:center;font-weight:700;font-size:1.25rem;color:#fff!important;letter-spacing:0.5px;box-shadow:0 2px 4px rgba(0,0,0,0.15)}
    .brand-link .brand-text{color:#fff!important}
    .main-sidebar{background:var(--primary-gradient)!important;width:240px!important;box-shadow:2px 0 5px rgba(0,0,0,0.1)}
    .sidebar .nav-link{color:rgba(255,255,255,0.85)!important;padding:0.75rem 1rem!important;border-radius:0!important;margin:0.15rem 0!important;transition:all 0.2s ease!important;font-weight:500;font-size:0.95rem}
    .sidebar .nav-link:hover{background:rgba(255,255,255,0.1)!important;color:#fff!important;padding-left:1.25rem!important;transform:translateX(4px)}
    .sidebar .nav-link.active{background:rgba(255,255,255,0.15)!important;color:#fff!important;border-left:4px solid #f39c12!important;padding-left:0.9rem!important}
    .sidebar .nav-link .nav-icon{color:rgba(255,255,255,0.7)!important;margin-right:0.75rem!important;width:20px;text-align:center}
    .sidebar .nav-link.active .nav-icon{color:#f39c12!important}
    .sidebar .nav-link p{margin:0!important;font-weight:500}
    .sidebar-user{text-align:center;padding:1.5rem 1rem 1rem 1rem;border-bottom:1px solid rgba(255,255,255,0.15);margin-bottom:1rem}
    .sidebar-user .avatar{width:60px;height:60px;border-radius:50%;background:rgba(255,255,255,0.2);border:3px solid rgba(255,255,255,0.3);margin:0 auto 0.75rem auto;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff}
    .sidebar-user .name{color:#fff;font-weight:600;font-size:1rem;display:block;margin-bottom:0.25rem}
    .sidebar-user .role{color:rgba(255,255,255,0.7);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.5px;background:rgba(255,255,255,0.15);padding:0.25rem 0.75rem;border-radius:20px;display:inline-block}
    .main-header{background:#fff!important;border-bottom:1px solid #e1e4e8!important;box-shadow:0 2px 4px rgba(0,0,0,0.05)!important;height:60px!important}
    .main-header .navbar-nav .nav-link{color:#495057!important;font-weight:500;font-size:0.9rem}
    .main-header .navbar-nav .nav-link:hover{color:var(--primary-color)!important}
    .content-wrapper{background:#f8f9fa!important;min-height:calc(100vh - 60px)!important}
    .content-wrapper .container-fluid{padding-top:1.5rem}
    .card{border:none!important;border-radius:12px!important;box-shadow:0 4px 6px rgba(0,0,0,0.05)!important;transition:transform 0.2s ease,box-shadow 0.2s ease!important;margin-bottom:1.5rem!important}
    .card:hover{transform:translateY(-2px);box-shadow:0 8px 12px rgba(0,0,0,0.1)!important}
    .card-header{background:#fff!important;border-bottom:1px solid #e9ecef!important;border-radius:12px 12px 0 0!important;padding:1rem 1.25rem!important;font-weight:600!important;font-size:1rem!important;color:var(--primary-color)!important}
    .card-body{padding:1.25rem!important}
    .small-box{border-radius:12px!important;box-shadow:0 4px 6px rgba(0,0,0,0.08)!important;transition:transform 0.2s ease!important}
    .small-box:hover{transform:translateY(-3px);box-shadow:0 8px 15px rgba(0,0,0,0.12)!important}
    .small-box .inner h3{font-size:2rem!important;font-weight:700!important}
    .small-box .icon{font-size:3rem!important;opacity:0.2!important}
    .btn{border-radius:6px!important;font-weight:500!important;transition:all 0.2s ease!important;padding:0.5rem 1.25rem!important}
    .btn:hover{transform:translateY(-1px);box-shadow:0 4px 8px rgba(0,0,0,0.15)!important}
    .btn-primary{background:var(--primary-gradient)!important;border:none!important}
    .btn-success{background:var(--success-gradient)!important;border:none!important}
    .btn-info{background:var(--info-gradient)!important;border:none!important}
    .btn-warning{background:var(--warning-gradient)!important;border:none!important}
    .btn-danger{background:var(--danger-gradient)!important;border:none!important}
    .btn-secondary{background:#6c757d!important;border:none!important}
    .table{border-radius:8px!important;overflow:hidden!important}
    .table thead{background:#f8f9fa!important}
    .table thead th{border:none!important;font-weight:600!important;font-size:0.85rem!important;text-transform:uppercase!important;letter-spacing:0.3px!important;color:#6c757d!important;padding:1rem!important}
    .table td{border:none!important;border-bottom:1px solid #e9ecef!important;font-size:0.9rem!important;padding:1rem!important;vertical-align:middle!important}
    .table-hover tbody tr:hover{background:#f1f3f5!important;transition:background 0.2s ease!important}
    .badge{border-radius:6px!important;font-weight:500!important;font-size:0.75rem!important;padding:0.4rem 0.8rem!important}
    .alert{border:none!important;border-radius:8px!important;padding:1rem 1.25rem!important;font-weight:500!important;box-shadow:0 2px 4px rgba(0,0,0,0.05)!important}
    .alert-success{background:#d4edda!important;color:#155724!important}
    .alert-danger{background:#f8d7da!important;color:#721c24!important}
    .form-group{margin-bottom:1.25rem!important}
    .form-group label{font-weight:600!important;font-size:0.9rem!important;color:#495057!important;margin-bottom:0.5rem!important;display:block!important}
    .form-control{border:1px solid #ced4da!important;border-radius:6px!important;padding:0.75rem 1rem!important;font-size:0.9rem!important;transition:all 0.2s ease!important}
    .form-control:focus{border-color:var(--primary-color)!important;box-shadow:0 0 0 3px rgba(44,62,80,0.1)!important}
    .invalid-feedback{color:#e74c3c!important;font-size:0.8rem!important;margin-top:0.25rem!important;font-weight:500!important}
    .main-footer{background:#fff!important;border-top:1px solid #e1e4e8!important;color:#6c757d!important;font-size:0.85rem!important;padding:1rem 0!important;text-align:center!important}
    .user-badge{background:#e9ecef;color:#495057;padding:0.2rem 0.6rem;border-radius:20px;font-size:0.75rem;font-weight:600;margin-left:0.5rem}
    .product-thumb{width:55px;height:55px;object-fit:cover;border-radius:6px}
    .currency{text-align:right}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
