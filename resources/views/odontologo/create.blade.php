@php
use Carbon\Carbon;
@endphp
@extends('template')

@section('title', 'Registrar Nuevo Odontologo')

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
        .gender-icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }
        #seguro-fields {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .form-check-input:checked {
            background-color: #4e73df;
            border-color: #4e73df;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-person-plus me-2"></i>Registrar Nuevo Odontologo</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('odontologo.index') }}">Odontologos</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tarjeta de Formulario -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-file-earmark-medical me-2"></i>Datos del Odontologo</h5>
        </div>

        <form action="{{ route('odontologo.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="card-body">
                <div class="row g-3">
                    <!-- CI -->
                    <div class="col-md-6 form-section">
                        <label for="ci" class="form-label">
                            <i class="bi bi-card-heading form-icon"> Cédula de Identidad</i>
                        </label>
                        <input type="text" name="ci" id="ci" class="form-control @error('ci') is-invalid @enderror"
                               value="{{ old('ci') }}" required placeholder="Ej: 1234567">
                        @error('ci')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="col-md-6 form-section">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-person-vcard form-icon"> Nombre(s)</i>
                        </label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre') }}" required placeholder="Ej: Pedro">
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="col-md-6 form-section">
                        <label for="appaterno" class="form-label">
                            <i class="bi bi-person form-icon"> Apellido Paterno</i>
                        </label>
                        <input type="text" name="appaterno" id="appaterno" class="form-control @error('appaterno') is-invalid @enderror"
                               value="{{ old('appaterno') }}" placeholder="Ej: Carmelo">
                        @error('appaterno')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6 form-section">
                        <label for="telefono" class="form-label">
                            <i class="bi bi-telephone form-icon"> Teléfono/Celular</i>
                        </label>
                        <input type="tel" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror"
                               value="{{ old('telefono') }}" pattern="[0-9]{7,15}" placeholder="Ej: 75312319">
                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Género -->
                    <div class="col-md-6 form-section">
                        <label class="form-label">
                            <i class="bi bi-gender-ambiguous form-icon"> Género</i>
                        </label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="M"
                                       {{ old('sexo') == 'M' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sexo_m">
                                    <i class="bi bi-gender-male gender-icon text-primary"> Masculino</i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="F"
                                       {{ old('sexo') == 'F' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sexo_f">
                                    <i class="bi bi-gender-female gender-icon text-danger"> Femenino</i>
                                </label>
                            </div>
                        </div>
                        @error('sexo')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Usuario -->
                    <div class="col-md-6 form-section">
                        <label for="idUsuario" class="form-label">
                            <i class="bi bi-envelope form-icon"> Asignar Usuario</i>
                        </label>
                        <select name="idUsuario" id="idUsuario"
                                class="form-select @error('idUsuario') is-invalid @enderror"
                                required>
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ old('idUsuario') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->email }}
                                </option>
                            @endforeach
                        </select>

                        @error('idUsuario')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('odontologo.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Registrar Odontologo
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mostrar/ocultar campos de seguro
    document.getElementById('seguro').addEventListener('change', function() {
        const seguroFields = document.getElementById('seguro-fields');
        if(this.checked) {
            seguroFields.style.display = 'block';
            seguroFields.style.height = 'auto';
        } else {
            seguroFields.style.display = 'none';
            seguroFields.style.height = '0';
        }
    });

    // Validación de fechas de seguro
    document.querySelector('form').addEventListener('submit', function(e) {
        const seguro = document.getElementById('seguro').checked;
        const fechaAdq = document.getElementById('fechaSeAdquirido').value;
        const fechaExp = document.getElementById('fechaSeExpiracion').value;

        if(seguro) {
            if(!fechaAdq || !fechaExp) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Datos incompletos',
                    text: 'Por favor complete las fechas de seguro',
                });
                return;
            }

            if(new Date(fechaExp) <= new Date(fechaAdq)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Fechas incorrectas',
                    text: 'La fecha de expiración debe ser posterior a la de adquisición',
                });
            }
        }
    });

    // Formato automático para CI (solo números)
    document.getElementById('ci').addEventListener('input', function(e) {
        this.value = this.value.replace(/\D/g, '');
    });

    // Formato automático para teléfono (solo números)
    document.getElementById('telefono').addEventListener('input', function(e) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
@endpush
