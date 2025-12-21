@php
use Carbon\Carbon;
@endphp
@extends('template')

@section('title', 'Registrar Nuevo Paciente')

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
            <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-person-plus me-2"></i>Registrar Nuevo Paciente</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('paciente.index') }}">Pacientes</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tarjeta de Formulario -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-file-earmark-medical me-2"></i>Datos del Paciente</h5>
        </div>

        <form action="{{ route('paciente.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="card-body">
                <div class="row g-3">
                    <!-- CI -->
                    <div class="col-md-6 form-section">
                        <label for="ci" class="form-label">
                            <i class="bi bi-card-heading form-icon"></i>Cédula de Identidad
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
                            <i class="bi bi-person-vcard form-icon"></i>Nombre(s)
                        </label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre') }}" required placeholder="Ej: Juan Carlos">
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="col-md-6 form-section">
                        <label for="appaterno" class="form-label">
                            <i class="bi bi-person form-icon"></i>Apellido Paterno
                        </label>
                        <input type="text" name="appaterno" id="appaterno" class="form-control @error('appaterno') is-invalid @enderror"
                               value="{{ old('appaterno') }}" placeholder="Ej: Pérez">
                        @error('appaterno')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Apellido Materno -->
                    <div class="col-md-6 form-section">
                        <label for="apmaterno" class="form-label">
                            <i class="bi bi-person form-icon"></i>Apellido Materno
                        </label>
                        <input type="text" name="apmaterno" id="apmaterno" class="form-control @error('apmaterno') is-invalid @enderror"
                               value="{{ old('apmaterno') }}" placeholder="Ej: González">
                        @error('apmaterno')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6 form-section">
                        <label for="telefono" class="form-label">
                            <i class="bi bi-telephone form-icon"></i>Teléfono/Celular
                        </label>
                        <input type="tel" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror"
                               value="{{ old('telefono') }}" pattern="[0-9]{7,15}" placeholder="Ej: 76543210">
                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Género -->
                    <div class="col-md-6 form-section">
                        <label class="form-label">
                            <i class="bi bi-gender-ambiguous form-icon"></i>Género
                        </label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="M"
                                       {{ old('sexo') == 'M' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sexo_m">
                                    <i class="bi bi-gender-male gender-icon text-primary"></i>Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="F"
                                       {{ old('sexo') == 'F' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sexo_f">
                                    <i class="bi bi-gender-female gender-icon text-danger"></i>Femenino
                                </label>
                            </div>
                        </div>
                        @error('sexo')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Seguro -->
                    <div class="col-12 form-section">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="seguro" id="seguro" value="1"
                                   {{ old('seguro') ? 'checked' : '' }}>
                            <label class="form-check-label" for="seguro">
                                <i class="bi bi-shield-check form-icon"></i>¿Tiene seguro médico?
                            </label>
                        </div>
                        @error('seguro')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Campos de Seguro (condicional) -->
                    <div id="seguro-fields" class="row g-3" style="{{ old('seguro') ? '' : 'display:none; height:0;' }}">
                        <div class="col-md-6 form-section">
                            <label for="fechaSeAdquirido" class="form-label">
                                <i class="bi bi-calendar-check form-icon"></i>Fecha de Adquisición
                            </label>
                            <input type="date" name="fechaSeAdquirido" id="fechaSeAdquirido"
                                   class="form-control @error('fechaSeAdquirido') is-invalid @enderror"
                                   value="{{ old('fechaSeAdquirido') }}">
                            @error('fechaSeAdquirido')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-section">
                            <label for="fechaSeExpiracion" class="form-label">
                                <i class="bi bi-calendar-x form-icon"></i>Fecha de Expiración
                            </label>
                            <input type="date" name="fechaSeExpiracion" id="fechaSeExpiracion"
                                   class="form-control @error('fechaSeExpiracion') is-invalid @enderror"
                                   value="{{ old('fechaSeExpiracion') }}">
                            @error('fechaSeExpiracion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('paciente.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Registrar Paciente
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
