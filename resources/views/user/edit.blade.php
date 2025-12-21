@extends('template')

@section('title', 'Editar Usuario')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .form-section {
            margin-bottom: 1.5rem;
        }
        .form-icon {
            color: #6c757d;
            margin-right: 0.5rem;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-person-gear me-2"></i>Editar Usuario</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index')}}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tarjeta de Formulario -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Información del Usuario</h5>
            <small class="text-muted">Los usuarios son los que pueden ingresar al sistema</small>
        </div>

        <form action="{{ route('user.update', $user) }}" method="post">
            @method('PATCH')
            @csrf

            <div class="card-body">
                <!-- Nombre -->
                <div class="form-section">
                    <label for="name" class="form-label">
                        <i class="bi bi-person-fill form-icon"></i>Nombre completo
                    </label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text mt-1">
                        Escriba el nombre completo del usuario
                    </div>
                </div>

                <!-- Email -->
                <div class="form-section">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope-fill form-icon"></i>Correo electrónico
                    </label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text mt-1">
                        Dirección de correo válida
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="form-section">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock-fill form-icon"></i>Contraseña
                    </label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text mt-1">
                        Deje en blanco si no desea cambiar la contraseña. Debe incluir números y caracteres especiales.
                    </div>
                </div>

                <!-- Confirmar contraseña -->
                <div class="form-section">
                    <label for="password_confirmation" class="form-label">
                        <i class="bi bi-lock-fill form-icon"></i>Confirmar contraseña
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Rol -->
                <div class="form-section">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin"
                               {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_admin">
                            <i class="bi bi-shield-fill-check form-icon"></i>Usuario administrador
                        </label>
                    </div>
                    <div class="form-text mt-1">
                        Los administradores tienen acceso completo al sistema
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Actualizar Usuario
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    // Validación básica del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password && password !== confirmPassword) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
        }
    });
</script>
@endpush
