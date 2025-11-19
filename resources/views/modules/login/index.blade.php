@extends('layouts.main')

@section('contenido')
<style>
    .auth-hero {
        position: relative; min-height: 100vh;
        background: url('/img/fondo1.jpg') center/cover no-repeat fixed;
        display: grid; place-items: center; color: #fff; isolation: isolate;
    }
    .auth-hero::after { content: ''; position: absolute; inset: 0;
        background: linear-gradient(120deg, rgba(0,0,0,.55), rgba(0,0,0,.25)); z-index: -1; }
    .brand-badge { display: inline-flex; align-items: center; gap:.5rem;
        padding:.5rem .9rem; background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25); border-radius:999px; backdrop-filter: blur(6px); }
    .brand-badge .dot { width:10px; height:10px; border-radius:50%; background:#51d1b9; box-shadow:0 0 0 3px rgba(81,209,185,.25); }
    .auth-card { width: 100%; max-width: 460px; border: 1px solid rgba(255,255,255,.25);
        border-radius: 1rem; background: rgba(255,255,255,.12); backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0,0,0,.25); }
    .auth-card .card-body { padding: 1.75rem; }
    .auth-title { font-weight: 800; letter-spacing: .3px; }
    .text-soft { color: rgba(255,255,255,.9); }
    .form-control { border-radius: .6rem; }
    .btn-cta { padding:.7rem 1rem; border-radius:.7rem; font-weight:600; }
    .btn-primary { background:#27b59a; border:none; }
    .btn-primary:hover { background:#1ea58c; }
    .alert-glass { background: rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.3); color:#fff; }
</style>

<section class="auth-hero">
    <div class="container px-3">
        <div class="mx-auto auth-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="brand-badge"><span class="dot"></span> Veterinaria</span>
                    <i class="bi bi-heart-fill" style="color:#ffefef"></i>
                </div>
                <h1 class="h3 auth-title mb-1">Login</h1>
                <p class="mb-3 text-soft">Ingresa con tu correo y contraseña.</p>

                @if (session('status'))
                    <div class="alert alert-glass py-2 px-3 mb-3">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('login.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="tu@correo.com" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-cta w-100">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
 
