<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Inicio -->
                <div class="sb-sidenav-menu-heading text-uppercase small fw-bold text-muted">Principal</div>
                <a class="nav-link py-3" href="{{ route('panel') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Panel de Control
                </a>

                <!-- Módulos -->
                <div class="sb-sidenav-menu-heading text-uppercase small fw-bold text-muted">Módulos</div>

                <!-- Odontologos -->
                <a class="nav-link py-3 {{ request()->routeIs('odontologo.*') ? 'active' : '' }}" href="{{ route('odontologo.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    odontologos
                    <span class="badge bg-primary float-end mt-1">{{ \App\Models\odontologo::count() }}</span>
                </a>

                <!-- Pacientes -->
                <a class="nav-link py-3 {{ request()->routeIs('paciente.*') ? 'active' : '' }}" href="{{ route('paciente.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    Pacientes
                    <span class="badge bg-primary float-end mt-1">{{ \App\Models\Paciente::count() }}</span>
                </a>

                <!-- Citas -->
                <a class="nav-link py-3 {{ request()->routeIs('citas.*') ? 'active' : '' }}" href="{{ route('citas.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    Citas
                    <span class="badge bg-info float-end mt-1">{{ \App\Models\Cita::count() }}</span>
                </a>

                <!-- Usuarios (Solo Admin) -->
                @if(auth()->check() && auth()->user()->is_admin)
                <a class="nav-link py-3 {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    Usuarios
                    <span class="badge bg-warning float-end mt-1">{{ \App\Models\User::count() }}</span>
                </a>
                @endif
            </div>
        </div>

        <!-- Footer del Sidebar -->
        <div class="sb-sidenav-footer bg-dark border-top border-secondary px-3 py-3">
            <div class="small text-muted">Bienvenido</div>
            <div class="fw-bold text-white">
                <i class="fas fa-user-circle me-1"></i>
                {{ auth()->user()->name }}
            </div>
            <div class="small text-muted mt-1">
                <i class="fas fa-circle text-success me-1" style="font-size: 8px;"></i>
                <h6 style="color: white">En linea</h6>
            </div>
        </div>
    </nav>
</div>
