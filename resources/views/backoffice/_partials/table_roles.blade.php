<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Permisos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($lista) == 0)
            <tr>
                <td colspan="5" class="text-center">Sin Registros</td>
            </tr>
        @else
            @foreach ($lista as $item)
                @php
                    // Agrupar todos los permisos por categoría (antes del primer guion '-')
                    $todosLosPermisosAgrupados = [];
                    foreach ($permisos as $permiso) {
                        $categoria = explode('-', $permiso->name)[0];
                        if (!isset($todosLosPermisosAgrupados[$categoria])) {
                            $todosLosPermisosAgrupados[$categoria] = [];
                        }
                        $todosLosPermisosAgrupados[$categoria][] = $permiso;
                    }
                    
                    // Permisos activos del rol actual
                    $permisosActivos = $item->permissions->pluck('name')->toArray();
                @endphp
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->name }}</td>
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPermisos{{ $item->id }}">
                            Permisos
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalPermisos{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title w-100" id="modalLabel{{ $item->id }}">
                                            <strong>Gestión de Permisos - {{ $item->name }}</strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <!-- Body -->
                                    <div class="modal-body">
                                        <form action="{{ route($datos['mantenedor']['routes']['permissions'], $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="modo" value="editar">
                                            
                                            <div class="text-center mb-4">
                                                <h6 class="text-body-secondary">Configura los permisos del rol</h6>
                                            </div>

                                            <!-- CSS para la nueva tabla de permisos -->
                                            <style>
                                                .permissions-table-container {
                                                    max-height: 500px;
                                                    overflow: auto;
                                                    border: 1px solid #dee2e6;
                                                    border-radius: 6px;
                                                }
                                                
                                                .permissions-table {
                                                    width: 100%;
                                                    border-collapse: collapse;
                                                    background: white;
                                                }
                                                
                                                .permissions-table th,
                                                .permissions-table td {
                                                    border: 1px solid #dee2e6;
                                                    padding: 8px 12px;
                                                    text-align: center;
                                                    white-space: nowrap;
                                                }
                                                
                                                .permissions-table thead th {
                                                    background-color: #f8f9fa;
                                                    font-weight: 600;
                                                    position: sticky;
                                                    top: 0;
                                                    z-index: 10;
                                                }
                                                
                                                .permissions-table tbody th {
                                                    background-color: #f8f9fa;
                                                    font-weight: 600;
                                                    position: sticky;
                                                    left: 0;
                                                    z-index: 5;
                                                }
                                                
                                                .permissions-table thead th:first-child {
                                                    position: sticky;
                                                    left: 0;
                                                    z-index: 15;
                                                }
                                                
                                                .select-all-buttons {
                                                    margin-bottom: 15px;
                                                    padding: 10px;
                                                    background-color: #f8f9fa;
                                                    border-radius: 6px;
                                                }
                                                
                                                .column-select-btn,
                                                .row-select-btn {
                                                    font-size: 0.75rem;
                                                    padding: 2px 6px;
                                                    margin: 2px;
                                                }
                                                
                                                .permission-checkbox {
                                                    transform: scale(1.2);
                                                }
                                                
                                                .category-header {
                                                    background-color: #e9ecef !important;
                                                    font-weight: bold;
                                                }
                                            </style>

                                            <!-- Botones de selección global -->
                                            <div class="select-all-buttons">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <button type="button" class="btn btn-outline-success btn-sm" onclick="selectAllPermissions({{ $item->id }})">
                                                            <i class="ti ti-check-all"></i> Seleccionar Todo
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="deselectAllPermissions({{ $item->id }})">
                                                            <i class="ti ti-square"></i> Deseleccionar Todo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tabla de permisos -->
                                            <div class="permissions-table-container">
                                                @php
                                                    // Obtener todos los permisos únicos por categoría
                                                    $categorias = array_keys($todosLosPermisosAgrupados);
                                                    
                                                    // Crear matriz de permisos por categoría y acción
                                                    $matrizPermisos = [];
                                                    foreach ($todosLosPermisosAgrupados as $categoria => $permisosPorCategoria) {
                                                        foreach ($permisosPorCategoria as $permiso) {
                                                            $accion = explode('-', $permiso->name, 2)[1] ?? $permiso->name;
                                                            $matrizPermisos[$categoria][$accion] = $permiso;
                                                        }
                                                    }
                                                    
                                                    // Obtener todas las acciones únicas
                                                    $acciones = [];
                                                    foreach ($matrizPermisos as $permisosPorCategoria) {
                                                        $acciones = array_merge($acciones, array_keys($permisosPorCategoria));
                                                    }
                                                    $acciones = array_unique($acciones);
                                                    sort($acciones);
                                                @endphp
                                                
                                                <table class="permissions-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Categoría / Acción</th>
                                                            @foreach ($acciones as $accion)
                                                                <th>
                                                                    <div>{{ ucfirst(str_replace('-', ' ', $accion)) }}</div>
                                                                    <button type="button" class="btn btn-outline-primary column-select-btn" 
                                                                            onclick="toggleColumnPermissions('{{ $accion }}', {{ $item->id }})">
                                                                        <i class="ti ti-check"></i>
                                                                    </button>
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categorias as $categoria)
                                                            <tr>
                                                                <th class="text-start">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <span>{{ ucfirst($categoria) }}</span>
                                                                        <button type="button" class="btn btn-outline-primary row-select-btn"
                                                                                onclick="toggleRowPermissions('{{ $categoria }}', {{ $item->id }})">
                                                                            <i class="ti ti-check"></i>
                                                                        </button>
                                                                    </div>
                                                                </th>
                                                                @foreach ($acciones as $accion)
                                                                    <td>
                                                                        @if (isset($matrizPermisos[$categoria][$accion]))
                                                                            @php $permiso = $matrizPermisos[$categoria][$accion]; @endphp
                                                                            <input class="form-check-input permission-checkbox 
                                                                                         category-{{ $categoria }}-{{ $item->id }}
                                                                                         action-{{ $accion }}-{{ $item->id }}"
                                                                                   type="checkbox" 
                                                                                   name="permissions[]" 
                                                                                   value="{{ $permiso->name }}"
                                                                                   id="{{ $permiso->name }}{{ $item->id }}"
                                                                                   {{ in_array($permiso->name, $permisosActivos) ? 'checked' : '' }} />
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <script>
                                                // Función para seleccionar/deseleccionar todos los permisos
                                                function selectAllPermissions(roleId) {
                                                    const checkboxes = document.querySelectorAll('#modalPermisos' + roleId + ' .permission-checkbox');
                                                    checkboxes.forEach(checkbox => checkbox.checked = true);
                                                }
                                                
                                                function deselectAllPermissions(roleId) {
                                                    const checkboxes = document.querySelectorAll('#modalPermisos' + roleId + ' .permission-checkbox');
                                                    checkboxes.forEach(checkbox => checkbox.checked = false);
                                                }

                                                // Función para toggle de permisos por columna (acción)
                                                function toggleColumnPermissions(accion, roleId) {
                                                    const checkboxes = document.querySelectorAll('.action-' + accion + '-' + roleId);
                                                    const checkedCount = document.querySelectorAll('.action-' + accion + '-' + roleId + ':checked').length;
                                                    const shouldCheck = checkedCount < checkboxes.length;
                                                    
                                                    checkboxes.forEach(checkbox => {
                                                        checkbox.checked = shouldCheck;
                                                    });
                                                }

                                                // Función para toggle de permisos por fila (categoría)
                                                function toggleRowPermissions(categoria, roleId) {
                                                    const checkboxes = document.querySelectorAll('.category-' + categoria + '-' + roleId);
                                                    const checkedCount = document.querySelectorAll('.category-' + categoria + '-' + roleId + ':checked').length;
                                                    const shouldCheck = checkedCount < checkboxes.length;
                                                    
                                                    checkboxes.forEach(checkbox => {
                                                        checkbox.checked = shouldCheck;
                                                    });
                                                }
                                            </script>

                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Guardar Permisos
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger" 
                                        onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i> Desactivar
                                </button>
                            </form>
                        @else
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary" 
                                        onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-up"></i> Activar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>