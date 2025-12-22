<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav nav-pills flex-column">

                <!-- Principal -->
                <div class="px-3 mt-2 mb-1">
                    <small class="text-secondary text-uppercase fw-semibold">
                        Principal
                    </small>
                    <hr class="my-1 opacity-25">
                </div>

                <a class="nav-link py-2 {{ request()->routeIs('panel') ? 'active fw-semibold' : '' }}"
                   href="{{ route('panel') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Panel de Control
                </a>

                <div class="px-3 mt-2 mb-1">
                    <small class="text-secondary text-uppercase fw-semibold">
                        Módulos
                    </small>
                    <hr class="my-1 opacity-25">
                </div>

                <!-- Odontólogos -->
                @if(auth()->check() && auth()->user()->is_admin)
                <a class="nav-link d-flex align-items-center justify-content-between
                    {{ request()->routeIs('odontologo.*') ? 'active fw-semibold' : '' }}"
                href="{{ route('odontologo.index') }}">
                    <span>
                        <i class="bi bi-person-badge me-2"></i>
                        Odontólogos
                    </span>
                    <span class="badge bg-primary rounded-pill">
                        {{ \App\Models\Odontologo::count() }}
                    </span>
                </a>
                @endif


                <!-- Pacientes -->
                <a class="nav-link d-flex align-items-center justify-content-between
                    {{ request()->routeIs('paciente.*') ? 'active fw-semibold' : '' }}"
                   href="{{ route('paciente.index') }}">
                    <span>
                        <i class="bi bi-people me-2"></i>
                        Pacientes
                    </span>
                    <span class="badge bg-success rounded-pill">
                        {{ \App\Models\Paciente::count() }}
                    </span>
                </a>

                <!-- Citas -->
                <a class="nav-link d-flex align-items-center justify-content-between
                    {{ request()->routeIs('citas.*') ? 'active fw-semibold' : '' }}"
                   href="{{ route('citas.index') }}">
                    <span>
                        <i class="bi bi-calendar2-check me-2"></i>
                        Citas
                    </span>
                    <span class="badge bg-info text-dark rounded-pill">
                        {{ \App\Models\Cita::count() }}
                    </span>
                </a>

                <!-- Usuarios (solo admin) -->
                @if(auth()->check() && auth()->user()->is_admin)
                <a class="nav-link d-flex align-items-center justify-content-between
                    {{ request()->routeIs('user.*') ? 'active fw-semibold' : '' }}"
                   href="{{ route('user.index') }}">
                    <span>
                        <i class="bi bi-people-fill me-2"></i>
                        Usuarios
                    </span>
                    <span class="badge bg-warning text-dark rounded-pill">
                        {{ \App\Models\User::count() }}
                    </span>
                </a>
                @endif

            </div>
        </div>

        <!-- Footer -->
        <div class="sb-sidenav-footer text-white">
            <div class="small text-secondary">Sesión activa</div>
            <div class="fw-semibold">
                <i class="bi bi-person-circle me-1"></i>
                {{ auth()->user()->name }}
            </div>
            <div class="small text-success mt-1">
                <i class="bi bi-circle-fill me-1"></i>
                En línea
            </div>
        </div>
    </nav>
</div>
