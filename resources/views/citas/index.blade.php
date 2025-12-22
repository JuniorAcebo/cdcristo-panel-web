@php
use Carbon\Carbon;
@endphp
@extends('template')

@section('title', 'Gestión de Citas')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .badge-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-completada {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-cancelada {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-confirmada {
            background-color: #cce5ff;
            color: #004085;
        }
        .table th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
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
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <!-- Notificación -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-3 end-3" style="z-index: 1100;" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-calendar-check me-2"></i>Gestión de Citas</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Citas</li>
                    </ol>
                </nav>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearCitaModal">
                <i class="bi bi-plus-lg me-1"></i> Nueva Cita
            </button>
        </div>

        <!-- Modal Crear Cita -->
        <div class="modal fade" id="crearCitaModal" tabindex="-1" aria-labelledby="crearCitaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="crearCitaModalLabel"><i class="bi bi-calendar-plus me-2"></i>Nueva Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('citas.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <!-- Paciente -->
                                <div class="col-md-6">
                                    <label class="form-label">Paciente:</label>
                                    <select name="idPaciente" class="form-select" required>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{ $paciente->id }}">
                                                {{ $paciente->nombre }} {{ $paciente->appaterno }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <!-- Servicio -->
                                <div class="col-md-6">
                                    <label class="form-label">Servicio:</label>
                                    <select name="idServicio" class="form-select" required>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}">
                                                {{ $servicio->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <!-- Odontólogo -->
                                <div class="col-md-6">
                                    <label class="form-label">Odontólogo:</label>
                                    <select name="idOdontologo" class="form-select" required>
                                        @foreach ($odontologos as $odontologo)
                                            <option value="{{ $odontologo->id }}">
                                                {{ $odontologo->nombre }} {{ $odontologo->appaterno }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <!-- Fecha y hora -->
                                <div class="col-md-12">
                                    <label class="form-label">Fecha y hora de la cita:</label>
                                    <input type="date" name="fecha" class="form-control" required>
                                    <input type="time" name="hora" class="form-control" required>

                                </div>

                            </div>

                            <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Cita
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Contenido -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-table me-2"></i>Listado de Citas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Profesional</th>
                                <th>Servicio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="patient-avatar me-3">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $cita->paciente->nombre }} {{ $cita->paciente->appaterno }}</h6>
                                            <small class="text-muted">{{ $cita->paciente->telefono }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Carbon::parse($cita->fechaHora)->format('d/m/Y') }}</td>
                                <td>{{ Carbon::parse($cita->fechaHora)->format('H:i') }}</td>
                                <td>{{ $cita->odontologo->nombre }}  {{ $cita->odontologo->appaterno }}</td>

                                <td class="text-truncate" style="max-width: 200px;" title="{{ $cita->motivo }}">
                                    {{ $cita->servicio->nombre }}
                                </td>
                                <td>
                                    <span class="badge rounded-pill
                                        @if($cita->estado == 0) badge-pendiente
                                        @elseif($cita->estado == 1) badge-completada
                                        @elseif($cita->estado == 2) badge-cancelada
                                        @endif">
                                        
                                        @if($cita->estado == 0) Pendiente
                                        @elseif($cita->estado == 1) Completada
                                        @elseif($cita->estado == 2) Cancelada
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        {{-- BOTÓN ELIMINAR --}}
                                        <button type="button"
                                            class="action-btn btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#Delete-{{ $cita->id }}"
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        {{-- BOTÓN COMPLETAR --}}
                                        @if ($cita->estado == 0)
                                            <form action="{{ route('citas.completar', $cita->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    type="submit"
                                                    class="action-btn btn btn-sm btn-outline-success"
                                                    title="Marcar como completada">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                             <!--Y NO ME DIGAS POBRE-->   
                            <!-- Modal Eliminar Cita -->
                            <div class="modal fade" id="Delete-{{ $cita->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title text-danger">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                Confirmar Eliminación de Cita
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p>
                                                ¿Estás seguro que deseas eliminar la cita del paciente:
                                            </p>

                                            <ul class="list-unstyled mb-3">
                                                <li><strong>CI:</strong> {{ $cita->paciente->ci }}</li>
                                                <li><strong>Paciente:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->appaterno }}</li>
                                                <li>
                                                    <strong>Fecha:</strong>
                                                    {{ \Carbon\Carbon::parse($cita->fechaHora)->format('d/m/Y') }}
                                                </li>
                                                <li>
                                                    <strong>Hora:</strong>
                                                    {{ \Carbon\Carbon::parse($cita->fechaHora)->format('H:i') }}
                                                </li>
                                            </ul>

                                            <p class="text-danger mb-0">
                                                <small><strong>Esta acción no se puede deshacer.</strong></small>
                                            </p>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash me-1"></i> Eliminar Cita
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
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
            $('#datatablesSimple').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                order: [[1, 'asc'], [2, 'asc']] // Ordenar por fecha y hora
            });

            // Auto-ocultar alerta después de 5 segundos
            setTimeout(() => {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
@endpush
