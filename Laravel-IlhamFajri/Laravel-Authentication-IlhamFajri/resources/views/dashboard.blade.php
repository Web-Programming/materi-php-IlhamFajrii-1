@extends('layout')

@section('title', 'Dashboard')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/dashboard">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/products">Produk</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success animated-alert" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="main-card text-center card-animate">
                <div class="mb-4">
                    <div style="font-size: 64px; margin-bottom: 16px;">👋</div>
                    <h1 class="fw-bold text-dark mb-2">Selamat datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-muted lead">Anda telah berhasil login ke sistem</p>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <a href="/products" class="btn btn-primary btn-modern w-100 py-2 fw-600">
                            📦 Lihat Produk
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-modern w-100 py-2 fw-600">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <p class="text-muted small">
                        <strong>Email:</strong> {{ Auth::user()->email }}<br>
                        <strong>Terdaftar sejak:</strong> {{ Auth::user()->created_at->format('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
