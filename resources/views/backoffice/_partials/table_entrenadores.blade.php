
@props(['lista', 'datos'])

<div class="table-responsive">
  <table class="datatables-users table border-top">
    <thead>
      <tr>
        <th>ID</th>
        <th>RUT</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Edad</th>
        <th>Género</th>
        <th>Nacionalidad</th>
        <th>Nivel</th>
        <th>Certificaciones</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($lista as $entrenador)
        @php
          // Decodificar certificaciones guardadas como JSON y mapear a etiquetas legibles
          $labels = [
            '1'=>'UEFA C','2'=>'UEFA B','3'=>'UEFA A','4'=>'UEFA Pro',
            '5'=>'CONMEBOL C','6'=>'CONMEBOL B','7'=>'CONMEBOL A','8'=>'CONMEBOL Pro',
          ];
          $ids  = is_string($entrenador->certificacion)
                    ? json_decode($entrenador->certificacion, true)
                    : ($entrenador->certificacion ?? []);
          $certs = collect($ids)->map(fn($id) => $labels[$id] ?? $id)->implode(', ');
        @endphp

        <tr>
          <td class="text-center">{{ $entrenador->persona?->user?->id ?? 'N/A' }}</td>
          <td class="text-center">{{ $entrenador->persona?->user?->rut ?? 'N/A' }}</td>
          <td>{{ $entrenador->persona?->user?->name ?? 'N/A' }}</td>
          <td>{{ $entrenador->persona?->user?->lastname ?? 'N/A' }}</td>
          <td>{{ $entrenador->persona?->edad ?? 'N/A' }}</td>
          <td>{{ $entrenador->persona?->user?->genero?->nombre ?? 'N/A' }}</td>
          <td>{{ $entrenador->persona?->nacionalidad?->nombre ?? 'N/A' }}</td>
          <td class="text-capitalize">{{ $entrenador->nivel ?? 'N/A' }}</td>
          <td>{{ $certs ?: '—' }}</td>

          <td class="text-center">
            @if ($entrenador->activo == 1)
              <span class="text-success">Activo</span>
            @else
              <span class="text-danger">Desactivado</span>
            @endif
          </td>

                <td class="text-center">
          <!-- Botones de acción -->
          @if ($entrenador->activo == 1)
              <form action="{{ route($datos['mantenedor']['routes']['down'], $entrenador->id) }}"
                  method="POST" class="d-inline-block">
                  @csrf
                  <button type="submit" class="btn btn-danger">
                      <i class="icon-base ti tabler-arrow-down"></i>
                  </button>
              </form>
          @endif

          

          @if ($entrenador->activo == 0)
              <form action="{{ route($datos['mantenedor']['routes']['up'], $entrenador->id) }}"
                  method="POST" class="d-inline-block">
                  @csrf
                  <button type="submit" class="btn btn-primary">
                      <i class="icon-base ti tabler-arrow-up"></i>
                  </button>
              </form>
          @endif
      </td>

        </tr>
      @empty
        <tr>
          <td colspan="11" class="text-center">Sin Registros</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<style>
    /* Scroll horizontal responsivo */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        /* Smooth scrolling en iOS */
    }

    /* Columna de acciones fija al lado derecho */
    .sticky-actions {
        position: sticky;
        right: 0;
        background-color: #fff;
        z-index: 10;
        box-shadow: -2px 0 4px rgba(0, 0, 0, 0.1);
    }

    /* Evitar que el texto se rompa en las celdas */
    .datatables-users th,
    .datatables-users td {
        white-space: nowrap;
    }
</style>
