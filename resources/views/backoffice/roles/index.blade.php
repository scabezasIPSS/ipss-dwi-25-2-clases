@extends('backoffice._partials.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">{{ $datos['mantenedor']['titulo'] }}</h4>
        <p class="mb-6">
            {{ $datos['mantenedor']['instruccion'] }}
        </p>

        @include('backoffice._partials.messages')

        <!-- Botón para Crear un Nuevo Rol -->
        <div class="d-flex justify-content-between mb-4">
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="btn btn-success">
                <i class="icon-base ti ti-plus"></i> Crear Nuevo Rol
            </a>
        </div>

        <!-- Role Table -->
        <div class="card">
            <div class="card-datatable">
                @include('backoffice._partials.table_roles', [
                    'lista' => $lista,
                    'datos' => $datos
                ])
            </div>
        </div>
        <!--/ Role Table -->

        <!-- Modal para agregar nuevo rol -->
        @include('backoffice._partials.modal', [
            'titulo' => $datos['mantenedor']['titulo'],
            'instruccion' => $datos['mantenedor']['instruccion'],
            'accion' => 'new',
            'ruta' => $datos['mantenedor']['routes']['new'],
            'campos' => $datos['mantenedor']['fields'],
            'permisos' => $permisos
        ])
        <!--/ Modal para agregar nuevo rol -->

    </div>
@endsection