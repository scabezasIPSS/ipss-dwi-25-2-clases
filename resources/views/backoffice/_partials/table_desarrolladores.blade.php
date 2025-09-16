@props(['desarrollador', 'datos'])

<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Rol</th>
            {{-- <th>Medios de Contacto</th> --}}
            <th>Versión de Software</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($desarrollador as $desarrollador_item)
            <tr>
                <td class="text-center">{{ $desarrollador_item->id }}</td>
                <td class="text-center"><img src="{{ $desarrollador_item->foto }}" alt="Foto" width="50"></td>
                <td class="text-center">{{ $desarrollador_item->nombre ?? 'N/A' }}</td>
                <td class="text-center">{{ $desarrollador_item->rol }}</td>
                {{-- <td class="text-center">
                    @foreach ($desarrollador_item->medios_contacto as $medio)
                        <a href="{{ $medio['url'] }}" target="_blank" class="mt-2">
                            {{ $medio['nombre'] }} [{{ $medio['url'] }}]
                        </a>
                    @endforeach
                </td> --}}
                <td class="text-center">{{ $desarrollador_item->version_software }}</td>
                <td class="text-center">{{ $desarrollador_item->descripcion_funcionalidades ?? 'N/A' }}</td>
                <td class="text-center">
                    <form action="{{ route($datos['mantenedor']['routes']['down'], $desarrollador_item) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Sin Registros</td>
            </tr>
        @endforelse
    </tbody>
</table>
