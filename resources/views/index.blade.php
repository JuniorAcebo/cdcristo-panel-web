@php
use Carbon\Carbon;
@endphp
@extends('template')

@section('title', 'Gestión de Mensajes')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .badge-cita {
            background-color: #e9d5ff;
            color: #7e22ce;
        }
        .badge-seguro {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-consulta {
            background-color: #fef9c3;
            color: #854d0e;
        }
        .badge-otro {
            background-color: #e2e8f0;
            color: #334155;
        }
        .unread-row {
            background-color: #f8fafc;
        }
        .message-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
        .modal-message {
            white-space: pre-line;
            line-height: 1.6;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-envelope me-2"></i>Gestión de Mensajes</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tarjeta de Contenido -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-inbox me-2"></i>Mensajes Recibidos</h5>
                <button id="markAllRead" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-check-all me-1"></i> Marcar todos como leídos
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($mensajes->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-envelope-open display-4 text-muted"></i>
                    <h5 class="mt-3 text-muted">No hay mensajes recibidos</h5>
                </div>
            @else
                <div class="table-responsive">
                    <table id="mensajesTable" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Remitente</th>
                                <th>Contacto</th>
                                <th>Asunto</th>
                                <th>Mensaje</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mensajes as $mensaje)
                            <tr class="{{ $mensaje->leido ? '' : 'unread-row' }}">
                                <td>
                                    <div class="{{ $mensaje->leido ? 'text-muted' : 'fw-bold' }}">{{ $mensaje->nombre }}</div>
                                    <small class="text-muted">{{ Carbon::parse($mensaje->created_at)->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div><i class="bi bi-envelope me-1"></i> {{ $mensaje->email }}</div>
                                    @if($mensaje->telefono)
                                        <div><i class="bi bi-telephone me-1"></i> {{ $mensaje->telefono }}</div>
                                    @endif
                                </td>
                                <td>
                                    @switch($mensaje->tipoasunto)
                                        @case(1) <span class="badge rounded-pill badge-cita">Cita</span> @break
                                        @case(2) <span class="badge rounded-pill badge-seguro">Seguro</span> @break
                                        @case(3) <span class="badge rounded-pill badge-consulta">Consulta</span> @break
                                        @case(4) <span class="badge rounded-pill badge-otro">Otro</span> @break
                                        @default <span class="badge rounded-pill bg-secondary">Sin Tipo</span>
                                    @endswitch
                                </td>
                                <td>
                                    <div class="message-preview">{{ Str::limit($mensaje->mensaje, 80) }}</div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button onclick="showMessage({{ $mensaje->id }})"
                                                class="action-btn btn btn-sm btn-outline-primary"
                                                title="Ver mensaje">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @if($mensaje->telefono)
                                        <a href="https://wa.me/591{{ $mensaje->telefono }}?text=Hola%20{{ urlencode($mensaje->nombre) }}%20hemos%20recibido%20tu%20mensaje"
                                           target="_blank"
                                           class="action-btn btn btn-sm btn-outline-success"
                                           title="Responder por WhatsApp">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para mostrar mensaje completo -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="messageModalLabel">
                    <i class="bi bi-envelope-open me-2"></i>Mensaje Completo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Remitente:</h6>
                        <p id="messageSender" class="fw-bold"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha:</h6>
                        <p id="messageDate"></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Email:</h6>
                        <p id="messageEmail"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Teléfono:</h6>
                        <p id="messagePhone"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Asunto:</h6>
                    <p id="messageSubject"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Mensaje:</h6>
                    <div id="fullMessage" class="modal-message"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Cerrar
                </button>
                <a id="whatsappBtn" href="#" target="_blank" class="btn btn-success">
                    <i class="bi bi-whatsapp me-1"></i> WhatsApp
                </a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#mensajesTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            order: [[0, 'desc']] // Ordenar por fecha más reciente
        });
    });

    // Mostrar mensaje completo en modal
    function showMessage(id) {
        fetch(`/mensajes/${id}/marcar-leido`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        const mensaje = @json($mensajes->keyBy('id'));
        const msg = mensaje[id];

        $('#messageSender').text(msg.nombre);
        $('#messageDate').text(new Date(msg.created_at).toLocaleString());
        $('#messageEmail').text(msg.email);
        $('#messagePhone').text(msg.telefono || 'N/A');

        // Asunto
        const asuntos = {
            1: 'Agendar Cita',
            2: 'Información por el Seguro',
            3: 'Consulta',
            4: 'Otro'
        };
        $('#messageSubject').html(`<span class="badge rounded-pill ${getBadgeClass(msg.tipoasunto)}">${asuntos[msg.tipoasunto] || 'Sin Tipo'}</span>`);

        // Mensaje
        $('#fullMessage').text(msg.mensaje);

        // Botón WhatsApp
        if(msg.telefono) {
            $('#whatsappBtn').attr('href', `https://wa.me/591${msg.telefono}?text=Hola%20${encodeURIComponent(msg.nombre)}%20hemos%20recibido%20tu%20mensaje`).show();
        } else {
            $('#whatsappBtn').hide();
        }

        // Mostrar modal
        const modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();

        // Actualizar fila como leída
        $(`tr[data-id="${id}"]`).removeClass('unread-row').find('.fw-bold').addClass('text-muted').removeClass('fw-bold');
    }

    function getBadgeClass(tipoasunto) {
        switch(tipoasunto) {
            case 1: return 'badge-cita';
            case 2: return 'badge-seguro';
            case 3: return 'badge-consulta';
            case 4: return 'badge-otro';
            default: return 'bg-secondary';
        }
    }

    // Marcar todos como leídos
    $('#markAllRead').click(function() {
        Swal.fire({
            title: '¿Marcar todos como leídos?',
            text: "Esta acción actualizará el estado de todos los mensajes no leídos",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4e73df',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, marcar como leídos',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/mensajes/marcar-todos-leidos`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if(response.ok) {
                        $('.unread-row').removeClass('unread-row').find('.fw-bold').addClass('text-muted').removeClass('fw-bold');
                        Swal.fire({
                            title: '¡Hecho!',
                            text: 'Todos los mensajes han sido marcados como leídos',
                            icon: 'success'
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
