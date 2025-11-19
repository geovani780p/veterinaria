@extends('layouts.main')

@section('contenido')
<div class="container py-4">
    <h1 class="h4 mb-3">Editar usuario</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('usuarios.update', $user) }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Correo</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <a class="btn btn-outline-secondary" href="{{ route('home') }}">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection