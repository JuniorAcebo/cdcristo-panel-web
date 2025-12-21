@php
use Carbon\Carbon;
@endphp
@extends('template')

@section('title', 'Gestión de Pacientes')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .badge-activo {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-inactivo {
            background-color: #f8d7da;
            color: #721c24;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .action-btn:hover {
            transform: scale(1.1);
        }
        .patient-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
        .gender-male {
            color: #0d6efd;
        }
        .gender-female {
            color: #dc3545;
        }
    </style>
@endpush

@section('content')
    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Éxito</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-people-fill me-2"></i>Gestión de Pacientes</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pacientes</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('paciente.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Paciente
            </a>
        </div>

        <!-- Tarjeta de Contenido -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-table me-2"></i>Registro de Pacientes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pacientes-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>CI</th>
                                <th>Paciente</th>
                                <th>Contacto</th>
                                <th>Sexo</th>
                                <th>Seguro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->ci }}</td>
                                    <td>{{ $paciente->nombre }} {{ $paciente->appaterno }}</td>
                                    <td>{{ $paciente->telefono ?? 'N/A' }}</td>
                                    <td>{{ $paciente->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                                    <td>
                                        <span class="badge {{ $paciente->seguro ? 'badge-activo' : 'badge-inactivo' }}">
                                            {{ $paciente->seguro ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('paciente.edit', $paciente->id) }}"
                                        class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $paciente->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($pacientes as $paciente)
                        <div class="modal fade" id="deleteModal{{ $paciente->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title text-danger">
                                            <i class="bi bi-exclamation-triangle me-2"></i> Confirmar Eliminación
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Eliminar al paciente: <strong>{{ $paciente->nombre }} {{ $paciente->appaterno }}</strong>?
                                        <br>
                                        <small class="text-danger"><strong>CI: {{ $paciente->ci }}</strong> <br>
                                        <i>Nota: Si elimina al Paciente, se eliminará todo su historial.</i><br>
                                        Esta acción no se puede deshacer. <br></small>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pacientes-table').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            columnDefs: [
                { orderable: false, targets: [5] } // Deshabilitar ordenamiento en columna de acciones
            ]
        });

        // Auto-ocultar notificación después de 5 segundos
        setTimeout(() => {
            $('.toast').toast('hide');
        }, 5000);
    });
</script>
@endpush
