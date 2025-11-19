@extends('layouts.main')

@section('contenido')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Administración de usuarios</h1>
        <div class="d-flex align-items-center gap-2">
            @if (session('status'))
                <div class="alert alert-info py-1 px-2 mb-0">{{ session('status') }}</div>
            @endif
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Cerrar sesión</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->activo ? 'Activo' : 'Inactivo' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
