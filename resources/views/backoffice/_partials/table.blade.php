<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>
                @foreach ($datos['mantenedor']['fields'] as $campos)
                    {{ $campos['label'] ?? 'Nombre' }}
                @endforeach
            </th>
            @if (isset($datos['mantenedor']['nombre']))
                <th>Nombre</th>
            @endif
            @if (isset($datos['mantenedor']['has_roles']) && $datos['mantenedor']['has_roles'])
                <th>Roles</th>
            @endif
            @if ($datos['mantenedor']['fields'][0]['label'] == 'Abreviatura')
                <th>Abreviatura</th>
            @endif
            {{-- Directiva para mostrar la columna Nombre condicionalmente --}}
            @if (isset($datos['mantenedor']['has_nombre']) && $datos['mantenedor']['has_nombre'])
                <th>Nombre</th>
            @endif
            {{-- Directiva para mostrar la columna Ubicación condicionalmente --}}
            @if (isset($datos['mantenedor']['has_ubicacion']) && $datos['mantenedor']['has_ubicacion'])
                <th>Ubicación</th>
            @endif

            @if (isset($datos['mantenedor']['has_entrenador']) && $datos['mantenedor']['has_entrenador'])
                <th>Entrenador</th>
            @endif

            @if (isset($datos['mantenedor']['has_jugador']) && $datos['mantenedor']['has_jugador'])
                <th>Jugador</th>
            @endif
            {{-- Directiva para mostrar la columna Categoria condicionalmente --}}
            @if (isset($datos['mantenedor']['has_categoria']) && $datos['mantenedor']['has_categoria'])
                <th>Categoria</th>
            @endif
            {{-- Directiva para mostrar la columna Recinto condicionalmente --}}
            @if (isset($datos['mantenedor']['has_recinto']) && $datos['mantenedor']['has_recinto'])
                <th>Recinto</th>
            @endif
            {{-- Directiva para mostrar la columna Dia condicionalmente --}}
            @if (isset($datos['mantenedor']['has_dia']) && $datos['mantenedor']['has_dia'])
                <th>Dia Entrenamiento</th>
            @endif
            @if (isset($datos['mantenedor']['has_hora_inicio']) && $datos['mantenedor']['has_hora_inicio'])
                <th>Hora Inicio</th>
            @endif
            @if (isset($datos['mantenedor']['has_hora_fin']) && $datos['mantenedor']['has_hora_fin'])
                <th>Hora Fin</th>
            @endif
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($lista) == 0)
            <tr>
                <td colspan="4" class="text-center">Sin Registros</td>
            </tr>
        @else
            @foreach ($lista as $item)
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    @if (isset($item->nombre))
                        <td>{{ $item->nombre }}</td>
                    @endif
                    @if (isset($datos['mantenedor']['has_roles']) && $datos['mantenedor']['has_roles'])
                        <td class="text-center">
                            @if ($item->roles->count() > 0)
                                @foreach ($item->roles as $role)
                                    <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Sin rol</span>
                            @endif
                        </td>
                    @endif
                    @if ($item->abreviatura)
                        <td class="text-center">{{ $item->abreviatura }}</td>
                    @endif
                    {{-- Directiva para mostrar la celda Ubicación condicionalmente --}}
                    @if (isset($datos['mantenedor']['has_nombre']) && $datos['mantenedor']['has_nombre'])
                        <td class="text-center">{{ $item->Nombre }}</td>
                    @endif
                    {{-- Directiva para mostrar la celda Ubicación condicionalmente --}}
                    @if (isset($datos['mantenedor']['has_ubicacion']) && $datos['mantenedor']['has_ubicacion'])
                        <td class="text-center">{{ $item->ubicacion }}</td>
                    @endif
                    {{-- Mstrar la celda Entrenador --}}
                    @if (isset($datos['mantenedor']['has_entrenador']) && $datos['mantenedor']['has_entrenador'])
                        <td class="text-center">{{ $item->entrenador }}</td>
                    @endif
                    {{-- Mostrar la celda Jugador --}}
                    @if (isset($datos['mantenedor']['has_jugador']) && $datos['mantenedor']['has_jugador'])
                        <td class="text-center">{{ $item->jugador }}</td>
                    @endif
                    {{-- Mostrar la celda Categoria Entrenamiento --}}
                    @if (isset($datos['mantenedor']['has_categoria']) && $datos['mantenedor']['has_categoria'])
                        <td class="text-center">{{ $item->categoria }}</td>
                    @endif
                    {{-- Mostrar la celda Recinto Entrenamiento --}}
                    @if (isset($datos['mantenedor']['has_recinto']) && $datos['mantenedor']['has_recinto'])
                        <td class="text-center">{{ $item->recinto }}</td>
                    @endif
                    {{-- Mostrar la celda Dia Entrenamiento --}}
                    @if (isset($datos['mantenedor']['has_dia']) && $datos['mantenedor']['has_dia'])
                        <td class="text-center">{{ $item->dia }}</td>
                    @endif
                    {{-- Mostrar la celda Hora Inicio/Fin --}}
                    @if (isset($datos['mantenedor']['has_hora_inicio']) && $datos['mantenedor']['has_hora_inicio'])
                        <td class="text-center">{{ $item->hora_inicio }}</td>
                    @endif
                    @if (isset($datos['mantenedor']['has_hora_fin']) && $datos['mantenedor']['has_hora_fin'])
                        <td class="text-center">{{ $item->hora_fin }}</td>
                    @endif
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                    <td class="text-center">
                        ver
                        actualizar
                        @if ($item->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}"
                                method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i>
                                </button>
                            </form>
                        @endif
                        @if ($item->activo == 0)
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary"
                                    onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-up"></i>
                                </button>
                            </form>
                        @endif
                        {{-- <form action="{{ route($datos['mantenedor']['routes']['destroy'], $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="icon-base ti tabler-trash"></i></button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
