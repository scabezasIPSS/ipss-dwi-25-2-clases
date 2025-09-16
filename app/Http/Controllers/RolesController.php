<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();
        $user->load('roles'); // ✅ roles cargados

        //$lista = RolesModel::all();
        $lista = RolesModel::with('permissions')->get();
        $permisos = Permission::all(); // ✅ todos los permisos
        $roles = Role::all();

        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Roles de Usuario',
                'instruccion' => 'Los roles de usuario definen qué puede hacer un usuario dentro del sistema.',
                'routes' => [
                    'new' => 'backoffice.roles.new',
                    'update' => 'backoffice.roles.update',
                    'up' => 'backoffice.roles.up',
                    'down' => 'backoffice.roles.down',
                    'delete' => 'backoffice.roles.destroy',
                    'permissions' => 'backoffice.roles.update.permissions', // 🔹 nueva ruta
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'roles_nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese un nombre'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                ]
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/roles/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
            'permisos' => $permisos,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Validación de los campos
        $request->validate([
            'roles_nombre' => ['required', 'string', 'max:50', 'min:3'],
        ]);

        // Crear un nuevo rol
        $nuevo = Role::create([
            'name' => $request->roles_nombre
        ]);
        /*
    $nuevo = RolesModel::create([
        'nombre' => $request->roles_nombre,
    ]);
    */

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', ':) Rol creado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RolesModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Rol apagado exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }

    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RolesModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Rol encendido exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }
    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RolesModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Rol eliminado exitosamente.');
    }

    public function updatePermissions(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
            'modo' => 'required|string|in:agregar,editar',
        ]);

        $role = Role::findOrFail($id);

        $permisos = $request->input('permissions', []);
        $modo = $request->input('modo');

        if ($modo === 'agregar') {
            // Agregar permisos sin eliminar los existentes
            $role->givePermissionTo($permisos);
        } elseif ($modo === 'editar') {
            // Reemplazar permisos
            $role->syncPermissions($permisos);
        }

        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }


    // Toggle (attach/detach) individual permiso via AJAX (fetch)
    public function togglePermission(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $request->validate([
            'permission' => 'required|string',
            'checked' => 'required|boolean',
        ]);

        $role = Role::findOrFail($id);
        $permName = $request->input('permission');

        if ($request->boolean('checked')) {
            if (! $role->hasPermissionTo($permName)) {
                $role->givePermissionTo($permName);
            }
            $status = 'attached';
        } else {
            if ($role->hasPermissionTo($permName)) {
                $role->revokePermissionTo($permName);
            }
            $status = 'detached';
        }

        return response()->json([
            'ok' => true,
            'status' => $status,
            'role' => $role->name,
            'permission' => $permName
        ]);
    }

    // METODO A FUTURO IMPLEMENTAR
    public function changeRole(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        // ✅ Validar que tenga el permiso adecuado
        if (!auth()->user()->can('rol-edit')) {
            return redirect()->back()->withErrors('No tiene permiso para cambiar roles.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $userAuth = Auth::user(); // Usuario autenticado
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        // ✅ Caso 1: el admin cambia su propio rol
        if ($user->id === $userAuth->id) {
            $userAuth->syncRoles([$role->name]);
            return redirect()->back()->with('success', "Te has cambiado al rol: {$role->name}");
        }

        // ✅ Caso 2: el admin cambia el rol de otro usuario
        $user->syncRoles([$role->name]);
        return redirect()->back()->with('success', "El usuario {$user->name} ahora tiene el rol: {$role->name}");
    }
}