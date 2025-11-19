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

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-success-subtle d-inline-block" style="width:10px;height:10px;"></div>
                                        <span>{{ $usuario->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $usuario->email }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $usuario->activo ? 'bg-success' : 'bg-secondary' }}">{{ $usuario->activo ? 'Activo' : 'Inactivo' }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <form method="post" action="{{ route('usuarios.toggle', $usuario) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $usuario->activo ? 'btn-outline-success' : 'btn-outline-secondary' }}">
                                                {{ $usuario->activo ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>

                                        <button type="button"
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#passwordModal"
                                                data-action="{{ route('usuarios.updatePassword', $usuario) }}"
                                        >Cambiar contraseña</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal cambiar contraseña -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Cambiar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="passwordForm" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                        </div>
                        <div class="small text-muted">Debe tener al menos 6 caracteres.</div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var passwordModal = document.getElementById('passwordModal');
            passwordModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var action = button.getAttribute('data-action');
                var form = document.getElementById('passwordForm');
                form.setAttribute('action', action);
                form.reset();
            });
        });
    </script>
</div>
@endsection
