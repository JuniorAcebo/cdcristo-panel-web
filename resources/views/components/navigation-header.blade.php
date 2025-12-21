<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary shadow-sm">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3 fw-bold" href="{{ route('panel') }}">
        <i class="fas fa-tooth me-2"></i>
    </a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search (Opcional) -->
    <div class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control border-0 shadow-sm" type="text" placeholder="Buscar..."
                   aria-label="Buscar" aria-describedby="btnNavbarSearch" style="min-width: 250px;">
            <button class="btn btn-light" id="btnNavbarSearch" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- User Dropdown -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fas fa-user-circle me-1"></i>
               <span class="d-none d-lg-inline">{{ Str::limit(auth()->user()->name, 15) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('user.index') }}">
                        <i class="fas fa-cog me-2 text-primary"></i>Configuraciones
                    </a>
                </li>

                <li><hr class="dropdown-divider my-2"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
