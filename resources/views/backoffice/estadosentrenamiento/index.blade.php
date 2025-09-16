@extends('backoffice._partials.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y" style="max-width: 1000px; margin: 0 auto;">
    <h4 class="mb-1">Lista de Estados</h4>

    @include('backoffice._partials.messages')

    <div class="d-flex justify-content-end mb-3">
        <!-- Botón Crear Estado -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateEstado">
            <i class="fa fa-plus-circle me-2"></i> Crear Estado
        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Mostrar todos los estados desde la base de datos --}}
                        @foreach($estadosExtras as $estado)
                        <tr class="{{ !$estado['activo'] ? 'table-secondary' : '' }}">
                            <td>{{ $estado['id'] }}</td>
                            <td>{{ $estado['nombre'] }}</td>
                            <td>
                                <span class="badge bg-{{ $estado['activo'] ? $estado['color'] : 'secondary' }}">
                                    {{ $estado['activo'] ? $estado['color'] : 'desactivado' }}
                                </span>
                            </td>
                            <td>
                              @if($estado['activo'])
                                
                                <form action="{{ route('backoffice.estadosentrenamiento.down', $estado['id']) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning mb-1">↓ Desactivar</button>
                                </form>
                              @else
                                <form action="{{ route('backoffice.estadosentrenamiento.up', $estado['id']) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mb-1">↑ Activar</button>
                                </form>
                              @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Estado -->
<div class="modal fade" id="modalCreateEstado" tabindex="-1" aria-labelledby="modalCreateEstadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('backoffice.estadosentrenamiento.new') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateEstadoLabel">Crear Estado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Estado</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required minlength="3" maxlength="50">
          </div>
          <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" id="color" class="form-control" placeholder="ej. success, warning, danger" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
