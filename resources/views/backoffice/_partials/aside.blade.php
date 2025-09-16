<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo">
        <a href="{{ route('backoffice.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ $datos['textos']['logo'] }}" alt="" width="32">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-3">{{ $datos['textos']['nombre'] }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        {{-- ejemplo --}}
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge text-bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small">
            <span class="menu-header-text">Mantenedores</span>
        </li>
        {{-- hay que editarlo, no puede partir en: active + open --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div>Débiles</div>
                <div class="badge text-bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.roles.index') active @endif">
                    <a href="{{ route('backoffice.roles.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Roles</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.cargos.index') active @endif">
                    <a href="{{ route('backoffice.cargos.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Cargos</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.recintos.index') active @endif">
                    <a href="{{ route('backoffice.recintos.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Recintos</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.camisetas.index') active @endif">
                    <a href="{{ route('backoffice.camisetas.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Camisetas</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.comunas.index') active @endif">
                    <a href="{{ route('backoffice.comunas.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Comunas</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.horainicio.index') active @endif">
                    <a href="{{ route('backoffice.horainicio.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Horas de inicio</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.horafin.index') active @endif">
                    <a href="{{ route('backoffice.horafin.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Horas de Término</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.mediospagos.index') active @endif">
                    <a href="{{ route('backoffice.mediospagos.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Medios de Pago</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.premios.index') active @endif">
                    <a href="{{ route('backoffice.premios.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Premios</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.posicion.index') active @endif">
                    <a href="{{ route('backoffice.posicion.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Posiciones</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.diassemana.index') active @endif">
                    <a href="{{ route('backoffice.diassemana.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-calendar"></i>
                        <div>Días de la Semana</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.nacionalidad.index') active @endif">
                    <a href="{{ route('backoffice.nacionalidad.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Nacionalidades</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.oficios.index') active @endif">
                    <a href="{{ route('backoffice.oficios.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Oficios</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.categoria.index') active @endif">
                    <a href="{{ route('backoffice.categoria.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Categorias</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.genero.index') active @endif">
                    <a href="{{ route('backoffice.genero.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-users"></i>
                        <div>Generos</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.piernadominante.index') active @endif">
                    <a href="{{ route('backoffice.piernadominante.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Pierna Dominante</div>
                    </a>
                </li>
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.mediocontacto.index') active @endif">
                    <a href="{{ route('backoffice.mediocontacto.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Medios de Contacto</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- ojo, aca también debe tener el active y open --}}

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div>Fuertes</div>
                <div class="badge text-bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (Route::currentRouteName() == 'backoffice.campeonato.index') active @endif">
                    <a href="{{ route('backoffice.campeonato.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-settings"></i>
                        <div>Campeonatos</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if (Route::currentRouteName() == 'backoffice.aside.index') active @endif">
            <a href="{{ route('backoffice.aside.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-settings"></i>
                <div>Aside</div>
            </a>
        </li>
        <li class="menu-item @if (Route::currentRouteName() == 'backoffice.users.index') active @endif">
            <a href="{{ route('backoffice.users.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-users"></i>
                <div>Usuarios</div>
            </a>
        </li>
        <li class="menu-item @if (Route::currentRouteName() == 'backoffice.entrenamiento.index') active @endif">
            <a href="{{ route('backoffice.entrenamiento.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-users"></i>
                <div>Entrenamiento</div>
            </a>
        </li>
        <li class="menu-item @if (str_starts_with(Route::currentRouteName(), 'backoffice.jugadores')) active @endif">
            <a href="{{ route('backoffice.jugadores.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-users"></i>
                <div>Jugadores</div>
            </a>
        </li>
        <li class="menu-item @if (Route::currentRouteName() == 'backoffice.equipos.index') active @endif">
            <a href="{{ route('backoffice.equipos.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-settings"></i>
                <div>Equipos</div>
            </a>
        </li>
        <li class="menu-item @if (Route::currentRouteName() == 'backoffice.equipo-jugador.index') active @endif">
            <a href="{{ route('backoffice.equipo-jugador.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-settings"></i>
                <div>Equipos Jugadores</div>
            </a>
        </li>
    </ul>
</aside>
