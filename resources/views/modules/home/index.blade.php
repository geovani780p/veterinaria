@extends('layouts.main')

@section('contenido')
<style>
    .hero {
        position: relative;
        min-height: 75vh;
        background: url('/img/fondo2.jpg') center/cover no-repeat fixed;
        display: flex;
        align-items: center;
        color: #fff;
        isolation: isolate;
    }
    .hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.55), rgba(0,0,0,.25));
        z-index: -1;
    }
    .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .5rem .9rem;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 999px;
        backdrop-filter: blur(6px);
    }
    .brand-badge .dot {
        width: 10px; height: 10px; border-radius: 50%; background: #51d1b9;
        box-shadow: 0 0 0 3px rgba(81,209,185,.25);
    }
    .hero-title { font-weight: 800; letter-spacing: .3px; }
    .hero-text { font-size: 1.1rem; opacity: .95; }
    .btn-cta { padding: .75rem 1.25rem; border-radius: .75rem; font-weight: 600; }
    .btn-cta-primary { background: #27b59a; border: none; }
    .btn-cta-primary:hover { background: #1ea58c; }
    .btn-cta-light { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.3); }
    .btn-cta-light:hover { background: rgba(255,255,255,.25); color: #fff; }

    .features { margin-top: -3rem; }
    .card-feature { border: 0; border-radius: 1rem; box-shadow: 0 12px 30px rgba(0,0,0,.08); }
    .icon {
        width: 44px; height: 44px; border-radius: .75rem; display: grid; place-items: center; color: #fff;
        box-shadow: 0 8px 20px rgba(0,0,0,.12);
    }
    .icon-pet { background: #27b59a; }
    .icon-vaccine { background: #7451ff; }
    .icon-calendar { background: #ff8a4c; }

    .section-heading { font-weight: 700; }

    .footer-note { color: #6c757d; font-size: .95rem; }
</style>

<header class="py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="brand-badge"><span class="dot"></span> Veterinaria</div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Cerrar sesión</button>
            </form>
        </div>
    </div>
    @if (session('status'))
        <div class="container mt-2">
            <div class="alert alert-info mb-0">{{ session('status') }}</div>
        </div>
    @endif
    @if ($errors->any())
        <div class="container mt-2">
            <div class="alert alert-danger mb-0">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    
</header>

<section class="hero">
    <div class="container py-5">
        <div class="col-12 col-lg-8">
            <div class="brand-badge mb-3"><span class="dot"></span> Cuidamos a tu mejor amigo</div>
            <h1 class="display-5 hero-title mb-3">Salud y bienestar para tus mascotas</h1>
            <p class="hero-text mb-4">Consultas generales, vacunación, desparasitación, estética canina y más. Atención profesional con cariño.</p>
            <div class="d-flex gap-2">
                <a href="#servicios" class="btn btn-cta btn-cta-primary">Nuestros servicios</a>
                <a href="#contacto" class="btn btn-cta btn-cta-light">Contacto</a>
            </div>
        </div>
    </div>
    
</section>

<section id="servicios" class="features">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="card card-feature p-4 h-100">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon icon-pet"><i class="bi bi-heart"></i></div>
                        <h5 class="mb-0">Consultas y emergencias</h5>
                    </div>
                    <p class="text-muted mb-0">Evaluación integral, diagnóstico y tratamiento con seguimiento. Atención de casos urgentes.</p>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card card-feature p-4 h-100">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon icon-vaccine"><i class="bi bi-shield-check"></i></div>
                        <h5 class="mb-0">Vacunación y prevención</h5>
                    </div>
                    <p class="text-muted mb-0">Calendarios de vacunas, desparasitación y control preventivo para vida larga y sana.</p>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card card-feature p-4 h-100">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon icon-calendar"><i class="bi bi-calendar-check"></i></div>
                        <h5 class="mb-0">Estética y cuidado</h5>
                    </div>
                    <p class="text-muted mb-0">Baños, cortes y cuidados especiales con productos de primera calidad.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacto" class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-12 col-lg-6">
                <h3 class="section-heading mb-2">Horarios y contacto</h3>
                <p class="text-muted mb-3">Lun-Vie 9:00–19:00 · Sáb 9:00–14:00</p>
                <div class="d-flex flex-column gap-1">
                    <span><strong>Tel:</strong> (xxx) xxx xxxx</span>
                    <span><strong>Dirección:</strong> Calle Veterinaria 123, Colonia Centro</span>
                    <span><strong>Email:</strong> contacto@veterinaria.com</span>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="mb-3">Escríbenos</h5>
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" placeholder="Tu nombre">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="email" class="form-control" placeholder="Tu correo">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="3" placeholder="¿Cómo podemos ayudarte?"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-cta btn-cta-primary mt-3" type="button">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        <p class="footer-note text-center mt-4">© {{ date('Y') }} Veterinaria · Con cariño para tus mascotas</p>
    </div>
</section>
@endsection