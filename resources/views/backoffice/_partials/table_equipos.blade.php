<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apodo</th>
            <th>Recinto</th>
            <th>Fundacion</th>
            <th>Trofeos</th>
            <th>Presidente</th>
            <th>Colores</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lista as $equipos)
            <tr>
                <td>{{ $equipos->id }}</td>
                <td>{{ $equipos->nombre }}</td> 
                <td>{{ $equipos->apodo }}</td>
                <td>{{ $equipos->recinto ? $equipos->recinto->nombre : 'Sin Recinto Asignado' }}</td>
                <td>{{ $equipos->fundacion }}</td>
                <td>{{ $equipos->trofeos }}</td>
                <td>{{ $equipos->presidente }}</td>
                <td>{{ $equipos->colores }}</td> 
                <td class="text-center">
                        @if ($equipos->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                    <td class="text-center">
{{--                         ver
                        actualizar --}}
                        @if ($equipos->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $equipos->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i>
                                </button>
                            </form>
                        @endif
                        @if ($equipos->activo == 0)
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $equipos->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-up"></i>
                                </button>
                            </form>
                        @endif
                        {{-- <form action="{{ route($datos['mantenedor']['routes']['destroy'], $equipos->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="icon-base ti tabler-trash"></i></button>
                        </form> --}}
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>


{{-- hla mundo --}}