<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary shadow-sm">

    <!-- Brand -->
    <a class="navbar-brand ps-3 fw-semibold d-flex align-items-center gap-2"
       href="{{ route('panel') }}">
        <i class="bi bi-heart-pulse-fill fs-5"></i>
        <span class="d-none d-sm-inline">Clínica Dental</span>
    </a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 text-white"
            id="sidebarToggle">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- ESPACIADOR que empuja todo a la derecha -->
    <div class="ms-auto"></div>

    <!-- Search -->
    <div class="d-none d-md-flex me-3">
        <div class="input-group input-group-sm">
            <span class="input-group-text bg-light border-0">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text"
                   class="form-control border-0"
                   placeholder="Buscar…"
                   aria-label="Buscar"
                   style="min-width: 220px;">
        </div>
    </div>

    <!-- User Menu -->
    <ul class="navbar-nav me-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-white"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                    <i class="bi bi-person-circle fs-5"></i>
                    <span class="d-none d-lg-inline">
                        {{ auth()->user()->name }}
                    </span>
            </a>


            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                aria-labelledby="navbarDropdown">

                <li class="px-3 py-2 text-muted small">
                    Sesión activa
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2"
                    href="{{ route('user.index') }}">
                        <i class="bi bi-gear text-primary"></i>
                        Configuración
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="dropdown-item d-flex align-items-center gap-2 text-danger">
                            <i class="bi bi-box-arrow-right"></i>
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>

        </li>
    </ul>

</nav>
