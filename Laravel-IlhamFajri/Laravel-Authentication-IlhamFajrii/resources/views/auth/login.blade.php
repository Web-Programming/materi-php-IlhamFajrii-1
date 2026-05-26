@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="main-card">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark mb-2">Masuk ke Akun</h2>
                    <p class="text-muted">Selamat datang kembali</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger animated-alert" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success animated-alert" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-600">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="Masukkan email Anda" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-600">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" 
                               placeholder="Masukkan password Anda" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-modern w-100 fw-600 py-2">
                        Masuk
                    </button>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">Belum punya akun? 
                        <a href="{{ route('register.show') }}" class="text-primary fw-600">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
