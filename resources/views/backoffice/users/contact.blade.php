<!doctype html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
      data-assets-path="/vuexy/assets/" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Perfil Usuario - Contacto</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/vuexy/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/vuexy/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/pickr/pickr-themes.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="/vuexy/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/css/pages/page-profile.css" />

    <!-- Helpers -->
    <script src="/vuexy/assets/vendor/js/helpers.js"></script>
    <script src="/vuexy/assets/vendor/js/template-customizer.js"></script>
    <script src="/vuexy/assets/js/config.js"></script>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('backoffice/_partials/aside')

        <div class="menu-mobile-toggler d-xl-none rounded-1">
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                <i class="ti tabler-menu icon-base"></i>
                <i class="ti tabler-chevron-right icon-base"></i>
            </a>
        </div>

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                 id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                        <i class="icon-base ti tabler-menu-2 icon-md"></i>
                    </a>
                </div>
                @include('backoffice/_partials/topbar')
            </nav>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @include('backoffice/users/_partials/header')
                    @include('backoffice/users/_partials/menu')
                    @include('backoffice/_partials/messages')

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-6">
                                <div class="card-body">
                                    <p class="card-text text-uppercase text-body-secondary small mb-4 fs-5">
                                        Cambio de datos personales
                                    </p>

                                    <form action="{{ route('backoffice.user.contact.update') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        {{-- Género --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Género</label>
                                            <select name="generoId" class="form-control mb-1 {{ $user->generoId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($generos as $genero)
                                                    <option value="{{ $genero->id }}" {{ $user->generoId == $genero->id ? 'selected' : '' }}>
                                                        {{ $genero->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->generoId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su género.' !!}
                                            </small>
                                        </div>

                                        {{-- Oficio --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Oficio</label>
                                            <select name="oficioId" class="form-control mb-1 {{ $user->oficioId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($oficios as $oficio)
                                                    <option value="{{ $oficio->id }}" {{ $user->oficioId == $oficio->id ? 'selected' : '' }}>
                                                        {{ $oficio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->oficioId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su oficio.' !!}
                                            </small>
                                        </div>

                                        {{-- Nacionalidad --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Nacionalidad</label>
                                            <select name="nacionalidadId" class="form-control mb-1 {{ $user->nacionalidadId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($nacionalidades as $nac)
                                                    <option value="{{ $nac->id }}" {{ $user->nacionalidadId == $nac->id ? 'selected' : '' }}>
                                                        {{ $nac->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->nacionalidadId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su nacionalidad.' !!}
                                            </small>
                                        </div>
                                        

                                        {{-- Comuna --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Comuna</label>
                                              <select name="comunaId" class="form-control mb-1 {{ $user->comunaId ? 'bg-info bg-opacity-10' : '' }}">
                                                  <option value="">Seleccione...</option>
                                                  @foreach ($comunas as $comuna)
                                                      <option value="{{ $comuna->id }}" {{ $user->comunaId == $comuna->id ? 'selected' : '' }}>
                                                          {{ $comuna->nombre }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                              <small class="text-muted d-block mb-3">
                                                {!! $user->comunaId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su comuna.' !!}
                                                </small>
                                        </div>
                                        

                                        {{-- Fecha de Nacimiento --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Fecha de Nacimiento</label>
                                            @php
                                                $fecha = old('nacimiento', $user->fechaNacimiento ? $user->fechaNacimiento->format('Y-m-d') : '');
                                            @endphp
                                            <input type="date" name="nacimiento"
                                                  value="{{ $fecha }}"
                                                  class="form-control mb-1 {{ $user->fechaNacimiento ? 'bg-info bg-opacity-10' : '' }}">
                                            <small class="text-muted d-block mb-3">
                                                    {!! $user->fechaNacimiento ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Ingrese su fecha de nacimiento.' !!}
                                            </small>
                                        </div>
                                            

                                        {{-- Pierna Dominante --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Pierna Dominante</label>
                                            <select name="piernaDominanteId" class="form-control mb-1 {{ $user->piernaDominanteId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($piernas as $pierna)
                                                    <option value="{{ $pierna->id }}" {{ $user->piernaDominanteId == $pierna->id ? 'selected' : '' }}>
                                                        {{ $pierna->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->piernaDominanteId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su pierna dominante.' !!}
                                            </small>   
                                        </div>                                     

                                        {{-- Medios de Contacto --}}
                                        <br>
                                        <h5 class="fw-bold mt-4 mb-3">Medios de Contacto</h5>
                                        <div id="medios-contacto">
                                            @foreach ($medios as $medio)
                                                @php
                                                    $pivot = $user->mediosDeContacto->where('id', $medio->id)->first()?->pivot;
                                                    $valor = $pivot->valor ?? '';
                                                    $visible = $pivot->visible ?? true; // por defecto visible
                                                @endphp
                                        
                                                <div class="mb-4 border border-3 rounded p-3 position-relative" id="medio-{{ $medio->id }}">

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label class="form-label fw-bold fs-5">{{ $medio->nombre }}</label>
                                        
                                                        {{-- Botón eliminar --}}
                                                        {{-- Mostrar botón "No agregar" solo si no hay valor guardado --}}
                                                        @if(!$valor)
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="document.getElementById('medio-{{ $medio->id }}').remove();">
                                                            <span class="iconify" data-icon="tabler-trash" data-inline="false"></span> No agregar
                                                        </button>
                                                        @endif
                                                    </div>
                                        
                                                    {{-- Campo de valor --}}
                                                    <input type="text"
                                                           name="medios[{{ $medio->id }}]"
                                                           value="{{ old('medios.' . $medio->id, $valor) }}"
                                                           class="form-control mb-2 {{ $valor ? 'bg-info bg-opacity-10' : '' }}"
                                                           placeholder="Ingrese {{ strtolower($medio->nombre) }}">
                                        
                                                    {{-- Checkbox de visibilidad --}}
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="visible-{{ $medio->id }}"
                                                               name="medios_visible[{{ $medio->id }}]"
                                                               value="1" {{ $visible ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="visible-{{ $medio->id }}">
                                                            Visible para otros usuarios
                                                        </label>
                                                    </div>
                                        
                                                    <small class="text-muted d-block mt-1">
                                                        {!! $valor ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Ingrese su ' . strtolower($medio->nombre) !!}
                                                    </small>                                                    
                                                </div>
                                            @endforeach
                                        </div>


                                        <button type="submit" class="btn btn-primary mt-2">
                                            <i class="menu-icon icon-base ti tabler-check"></i> Guardar Cambios
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                            <div class="text-body">
                                © <script>document.write(new Date().getFullYear());</script>, hecho con ❤️
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- / Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<script src="/vuexy/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/vuexy/assets/vendor/libs/popper/popper.js"></script>
<script src="/vuexy/assets/vendor/js/bootstrap.js"></script>
<script src="/vuexy/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="/vuexy/assets/vendor/libs/@algolia/autocomplete-js.js"></script>
<script src="/vuexy/assets/vendor/libs/pickr/pickr.js"></script>
<script src="/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/vuexy/assets/vendor/libs/hammer/hammer.js"></script>
<script src="/vuexy/assets/vendor/libs/i18n/i18n.js"></script>
<script src="/vuexy/assets/vendor/js/menu.js"></script>

<!-- Vendors JS -->
<script src="/vuexy/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<!-- Main JS -->
<script src="/vuexy/assets/js/main.js"></script>
<script src="/vuexy/assets/js/app-user-view-account.js"></script>
</body>
</html>