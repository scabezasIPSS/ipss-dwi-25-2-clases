@props(['destacados', 'datos'])

<div class="table-responsive">
    <table class="datatables-users table border-top">
        <thead>
            <tr>
                <th>#</th>
                <th>Jugador</th>
                <th>Posición</th>
                <th>Pierna</th>
                <th>Nacionalidad</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Publicación</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($destacados as $i => $d)
                @php
                    $persona = optional(optional($d->jugador)->persona);
                @endphp
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ trim(($persona->user->name ?? '') . ' ' . ($persona->user->lastname ?? '')) ?: 'Jugador #'.$d->jugadorId }}</td>
                    <td>{{ optional($d->jugador->posicion)->nombre ?? 'N/A' }}</td>
                    <td>{{ optional($d->jugador->piernaDominante)->nombre ?? 'N/A' }}</td>
                    <td>{{ optional($persona->nacionalidad)->nombre ?? 'N/A' }}</td>
                    <td>{{ $d->mesNombre ?? $d->mes }}</td>
                    <td>{{ $d->anio }}</td>
                    <td>{{ optional($d->fechaPublicacion)->format('d/m/Y H:i') }}</td>
                    <td>{{ $d->descripcion }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Sin Registros</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .sticky-actions {
        position: sticky;
        right: 0;
        background-color: #fff;
        z-index: 10;
        box-shadow: -2px 0 4px rgba(0,0,0,0.1);
    }
    .datatables-users th,
    .datatables-users td {
        white-space: nowrap;
    }
</style>
