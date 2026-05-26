<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        /* Topbar */
        .topbar {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 15px 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 20px;
            text-decoration: none;
            color: white;
        }

        .topbar-logo i {
            font-size: 28px;
        }

        .topbar-search {
            flex: 1;
            margin-left: 30px;
            max-width: 400px;
        }

        .topbar-search form {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .topbar-search input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            flex: 1;
            transition: all 0.3s ease;
        }

        .topbar-search input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .topbar-search input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            outline: none;
        }

        .topbar-search button {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .topbar-search button:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 18px;
        }

        .user-info {
            text-align: left;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .user-role {
            font-size: 11px;
            opacity: 0.8;
            white-space: nowrap;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            width: 260px;
            position: fixed;
            left: 0;
            top: 70px;
            height: calc(100vh - 70px);
            padding: 30px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.08);
            overflow-y: auto;
            z-index: 1020;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 25px;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .sidebar-menu a i {
            font-size: 18px;
            min-width: 20px;
        }

        .sidebar-menu a:hover {
            background: #f3f4f6;
            color: #667eea;
            padding-left: 30px;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-right: 4px solid #667eea;
        }

        .sidebar-menu a.active i {
            color: white;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 5px 0;
        }

        .page-subtitle {
            font-size: 14px;
            color: #9ca3af;
            margin: 0;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card.blue::before {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card.green::before {
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
        }

        .stat-card.red::before {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
        }

        .stat-card.orange::before {
            background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .stat-card.blue .stat-icon {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .stat-card.green .stat-icon {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .stat-card.red .stat-icon {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .stat-card.orange .stat-icon {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #9ca3af;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-change {
            font-size: 12px;
            color: #10b981;
            font-weight: 600;
        }

        .stat-change.down {
            color: #ef4444;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .topbar-search {
                display: none;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-value {
                font-size: 24px;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-left">
            <a href="/admin/dashboard" class="topbar-logo">
                <i class="bi bi-boxes"></i>
                <span>PT. ABC Inventaris</span>
            </a>
            <div class="topbar-search">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="w-100">
                    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" autocomplete="off">
                    <button type="submit" title="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="topbar-right">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Admin</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="border: none; background: none; font-size: 20px; text-decoration: none; color: #ef4444; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#ef4444'" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="/admin/dashboard" class="@if(Route::currentRouteName() == 'admin.dashboard') active @endif">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/pesanan" class="@if(Route::currentRouteName() == 'admin.pesanan') active @endif">
                    <i class="bi bi-cart3"></i>
                    <span>Pesanan</span>
                </a>
            </li>
            <li>
                <a href="/products" class="@if(in_array(Route::currentRouteName(), ['products.index', 'products.show', 'products.edit'])) active @endif">
                    <i class="bi bi-box"></i>
                    <span>Data Barang</span>
                </a>
            </li>
            <li>
                <a href="/products/create" class="@if(Route::currentRouteName() == 'products.create') active @endif">
                    <i class="bi bi-plus-circle"></i>
                    <span>Tambah Barang</span>
                </a>
            </li>
            <li>
                <a href="/admin/laporan" class="@if(Route::currentRouteName() == 'admin.laporan') active @endif">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span>Laporan</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-js')
</body>
</html>
