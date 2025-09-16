<?php

use App\Http\Controllers\AsideController;
use App\Http\Controllers\CamisetasController;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComunasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesarrolladorController;
use App\Http\Controllers\DiasSemanaController;
use App\Http\Controllers\EntrenamientosController;
use App\Http\Controllers\EquipoJugadorController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\EstadosEntrenamientoController;
use App\Http\Controllers\EstadosPagoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\HoraFinController;
use App\Http\Controllers\HorainicioController;
use App\Http\Controllers\JugadorDelMesController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MedioContactoController;
use App\Http\Controllers\MediosPagosController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\OficiosController;
use App\Http\Controllers\PiernaDominanteController;
use App\Http\Controllers\PosicionController;
use App\Http\Controllers\PremiosController;
use App\Http\Controllers\RecintosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoPartidoController;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

Route::aliasMiddleware('role', RoleMiddleware::class);
Route::aliasMiddleware('permission', PermissionMiddleware::class);

Route::get('/', [LandingPageController::class, 'index'])->name('/');

Route::get('/backoffice', [DashboardController::class, 'index'])->name('backoffice.dashboard');

//usuario
Route::get('/backoffice/login', [UserController::class, 'showFormLogin'])->name('user.form.show.login');
Route::post('/backoffice/login', [UserController::class, 'login'])->name('user.form.login');

Route::get('/backoffice/create-user', [UserController::class, 'showFormRegistro'])->name('user.form.show.registro');
Route::post('/backoffice/create-user', [UserController::class, 'guardarNuevo'])->name('user.form.registro');

Route::get('/backoffice/user/profile', [UserController::class, 'showPerfil'])->name('backoffice.user.profile');
Route::get('/backoffice/user/contact', [UserController::class, 'showContacto'])->name('backoffice.user.contact');
Route::get('/backoffice/user/security', [UserController::class, 'showSeguridad'])->name('backoffice.user.security');
Route::post('/backoffice/user/security', [UserController::class, 'cambiarClave'])->name('backoffice.user.security.changePass');

Route::get('/backoffice/users', [UserController::class, 'index'])->name('backoffice.users.index');
Route::post('/backoffice/users', [UserController::class, 'store'])->name('backoffice.users.new');
Route::post('/backoffice/users/down/{_id}', [UserController::class, 'down'])->name('backoffice.users.down');
Route::post('/backoffice/users/up/{_id}', [UserController::class, 'up'])->name('backoffice.users.up');
Route::post('/backoffice/users/destroy/{_id}', [UserController::class, 'destroy'])->name('backoffice.users.destroy');


Route::post('/backoffice/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/backoffice/roles', [RolesController::class, 'index'])->name('backoffice.roles.index');
Route::post('/backoffice/roles', [RolesController::class, 'store'])->name('backoffice.roles.new');
Route::post('/backoffice/roles/down/{_id}', [RolesController::class, 'down'])->name('backoffice.roles.down');
Route::post('/backoffice/roles/up/{_id}', [RolesController::class, 'up'])->name('backoffice.roles.up');
Route::post('/backoffice/roles/destroy/{_id}', [RolesController::class, 'destroy'])->name('backoffice.roles.destroy');

Route::put('/backoffice/roles/{id}/permissions', [RolesController::class, 'updatePermissions'])
    ->name('backoffice.roles.update.permissions');
Route::post('/backoffice/roles/{id}/permissions/toggle', [RolesController::class, 'togglePermission'])
    ->name('backoffice.roles.toggle.permission');

Route::get('/backoffice/cargos', [CargosController::class, 'index'])->name('backoffice.cargos.index');
Route::post('/backoffice/cargos', [CargosController::class, 'store'])->name('backoffice.cargos.new');
Route::post('/backoffice/cargos/down/{_id}', [CargosController::class, 'down'])->name('backoffice.cargos.down');
Route::post('/backoffice/cargos/up/{_id}', [CargosController::class, 'up'])->name('backoffice.cargos.up');
Route::post('/backoffice/cargos/destroy/{_id}', [CargosController::class, 'destroy'])->name('backoffice.cargos.destroy');

// Javiera Gonzalez

Route::get('/backoffice/recintos', [RecintosController::class, 'index'])->name('backoffice.recintos.index');
Route::post('/backoffice/recintos', [RecintosController::class, 'store'])->name('backoffice.recintos.new');
Route::post('/backoffice/recintos/down/{_id}', [RecintosController::class, 'down'])->name('backoffice.recintos.down');
Route::post('/backoffice/recintos/up/{_id}', [RecintosController::class, 'up'])->name('backoffice.recintos.up');
Route::post('/backoffice/recintos/destroy/{_id}', [RecintosController::class, 'destroy'])->name('backoffice.recintos.destroy');

// Paula Leon

Route::get('/backoffice/camisetas', [CamisetasController::class, 'index'])->name('backoffice.camisetas.index');
Route::post('/backoffice/camisetas', [CamisetasController::class, 'store'])->name('backoffice.camisetas.new');
Route::post('/backoffice/camisetas/down/{_id}', [CamisetasController::class, 'down'])->name('backoffice.camisetas.down');
Route::post('/backoffice/camisetas/up/{_id}', [CamisetasController::class, 'up'])->name('backoffice.camisetas.up');
Route::post('/backoffice/camisetas/destroy/{_id}', [CamisetasController::class, 'destroy'])->name('backoffice.camisetas.destroy');

// Santos Cruz

Route::get('/backoffice/comunas', [ComunasController::class, 'index'])->name('backoffice.comunas.index');
Route::post('/backoffice/comunas', [ComunasController::class, 'store'])->name('backoffice.comunas.new');
Route::post('/backoffice/comunas/down/{_id}', [ComunasController::class, 'down'])->name('backoffice.comunas.down');
Route::post('/backoffice/comunas/up/{_id}', [ComunasController::class, 'up'])->name('backoffice.comunas.up');
Route::post('/backoffice/comunas/destroy/{_id}', [ComunasController::class, 'destroy'])->name('backoffice.comunas.destroy');

// Jean Doizi

Route::get('/backoffice/horainicio', [HorainicioController::class, 'index'])->name('backoffice.horainicio.index');
Route::post('/backoffice/horainicio', [HorainicioController::class, 'store'])->name('backoffice.horainicio.new');
Route::post('/backoffice/horainicio/down/{_id}', [HorainicioController::class, 'down'])->name('backoffice.horainicio.down');
Route::post('/backoffice/horainicio/up/{_id}', [HorainicioController::class, 'up'])->name('backoffice.horainicio.up');
Route::post('/backoffice/horainicio/destroy/{_id}', [HorainicioController::class, 'destroy'])->name('backoffice.horainicio.destroy');

// Gerard Aliaga

Route::get('/backoffice/horafin', [HoraFinController::class, 'index'])->name('backoffice.horafin.index');
Route::post('/backoffice/horafin', [HoraFinController::class, 'store'])->name('backoffice.horafin.new');
Route::post('/backoffice/horafin/down/{_id}', [HoraFinController::class, 'down'])->name('backoffice.horafin.down');
Route::post('/backoffice/horafin/up/{_id}', [HoraFinController::class, 'up'])->name('backoffice.horafin.up');
Route::post('/backoffice/horafin/destroy/{_id}', [HoraFinController::class, 'destroy'])->name('backoffice.horafin.destroy');

// Miguel Cabello

Route::get('/backoffice/pagos', [MediosPagosController::class, 'index'])->name('backoffice.mediospagos.index');
Route::post('/backoffice/pagos', [MediosPagosController::class, 'store'])->name('backoffice.mediospagos.new');
Route::get('/backoffice/pagos/{_id}', [MediosPagosController::class, 'show'])->name('backoffice.mediospagos.show');
Route::get('/backoffice/pagos/{_id}/edit', [MediosPagosController::class, 'edit'])->name('backoffice.mediospagos.edit');
Route::post('/backoffice/pagos/down/{_id}', [MediosPagosController::class, 'down'])->name('backoffice.mediospagos.down');
Route::post('/backoffice/pagos/up/{_id}', [MediosPagosController::class, 'up'])->name('backoffice.mediospagos.up');
Route::post('/backoffice/pagos/destroy/{_id}', [MediosPagosController::class, 'destroy'])->name('backoffice.mediospagos.destroy');

// Luciano Lopresti
Route::get('/backoffice/premios', [PremiosController::class, 'index'])->name('backoffice.premios.index');
Route::post('/backoffice/premios', [PremiosController::class, 'store'])->name('backoffice.premios.new');
Route::post('/backoffice/premios/down/{_id}', [PremiosController::class, 'down'])->name('backoffice.premios.down');
Route::post('/backoffice/premios/up/{_id}', [PremiosController::class, 'up'])->name('backoffice.premios.up');
Route::post('/backoffice/premios/destroy/{_id}', [PremiosController::class, 'destroy'])->name('backoffice.premios.destroy');

// Ethan Mayorines
Route::get('/backoffice/posicion', [PosicionController::class, 'index'])->name('backoffice.posicion.index');
Route::post('/backoffice/posicion', [PosicionController::class, 'store'])->name('backoffice.posicion.new');
Route::post('/backoffice/posicion/down/{_id}', [PosicionController::class, 'down'])->name('backoffice.posicion.down');
Route::post('/backoffice/posicion/up/{_id}', [PosicionController::class, 'up'])->name('backoffice.posicion.up');
Route::post('/backoffice/posicion/destroy/{_id}', [PosicionController::class, 'destroy'])->name('backoffice.posicion.destroy');

// Cristian Gomez

Route::get('/backoffice/campeonato', [CampeonatoController::class, 'index'])->name('backoffice.campeonato.index');
Route::post('/backoffice/campeonato', [CampeonatoController::class, 'store'])->name('backoffice.campeonato.store');
Route::post('/backoffice/campeonato/down/{_id}', [CampeonatoController::class, 'down'])->name('backoffice.campeonato.down');
Route::post('/backoffice/campeonato/up/{_id}', [CampeonatoController::class, 'up'])->name('backoffice.campeonato.up');
Route::post('/backoffice/campeonato/destroy/{_id}', [CampeonatoController::class, 'destroy'])->name('backoffice.campeonato.destroy');

// Indira Anignir
Route::get('/backoffice/dias-semana', [DiasSemanaController::class, 'index'])->name('backoffice.diassemana.index');
Route::post('/backoffice/dias-semana', [DiasSemanaController::class, 'store'])->name('backoffice.diassemana.new');
Route::post('/backoffice/dias-semana/down/{_id}', [DiasSemanaController::class, 'down'])->name('backoffice.diassemana.down');
Route::post('/backoffice/dias-semana/up/{_id}', [DiasSemanaController::class, 'up'])->name('backoffice.diassemana.up');
Route::post('/backoffice/dias-semana/destroy/{_id}', [DiasSemanaController::class, 'destroy'])->name('backoffice.diassemana.destroy');

// Manuel Mena

Route::get('/backoffice/nacionalidad', [NacionalidadController::class, 'index'])->name('backoffice.nacionalidad.index');
Route::post('/backoffice/nacionalidad', [NacionalidadController::class, 'store'])->name('backoffice.nacionalidad.new');
Route::post('/backoffice/nacionalidad/down/{_id}', [NacionalidadController::class, 'down'])->name('backoffice.nacionalidad.down');
Route::post('/backoffice/nacionalidad/up/{_id}', [NacionalidadController::class, 'up'])->name('backoffice.nacionalidad.up');
Route::post('/backoffice/nacionalidad/destroy/{_id}', [NacionalidadController::class, 'destroy'])->name('backoffice.nacionalidad.destroy');

// Hector Gonzalez

Route::get('/backoffice/oficios', [OficiosController::class, 'index'])->name('backoffice.oficios.index');
Route::post('/backoffice/oficios', [OficiosController::class, 'store'])->name('backoffice.oficios.new');
Route::post('/backoffice/oficios/down/{_id}', [OficiosController::class, 'down'])->name('backoffice.oficios.down');
Route::post('/backoffice/oficios/up/{_id}', [OficiosController::class, 'up'])->name('backoffice.oficios.up');
Route::post('/backoffice/oficios/destroy/{_id}', [OficiosController::class, 'destroy'])->name('backoffice.oficios.destroy');

// Robert Leyton
Route::get('/backoffice/Categoria', [CategoriaController::class, 'index'])->name('backoffice.categoria.index');
Route::post('/backoffice/Categoria', [CategoriaController::class, 'store'])->name('backoffice.categoria.new');
Route::post('/backoffice/Categoria/down/{_id}', [CategoriaController::class, 'down'])->name('backoffice.categoria.down');
Route::post('/backoffice/Categoria/up/{_id}', [CategoriaController::class, 'up'])->name('backoffice.categoria.up');
Route::post('/backoffice/Categoria/destroy/{_id}', [CategoriaController::class, 'destroy'])->name('backoffice.categoria.destroy');

// Andrea Horna
Route::get('/backoffice/genero', [GeneroController::class, 'index'])->name('backoffice.genero.index');
Route::post('/backoffice/genero', [GeneroController::class, 'store'])->name('backoffice.genero.store');
Route::post('/backoffice/genero/down/{_id}', [GeneroController::class, 'down'])->name('backoffice.genero.down');
Route::post('/backoffice/genero/up/{_id}', [GeneroController::class, 'up'])->name('backoffice.genero.up');
Route::post('/backoffice/genero/destroy/{id}', [GeneroController::class, 'destroy'])->name('backoffice.genero.destroy');

// Vicente Vargas
Route::get('/backoffice/piernadominante', [PiernaDominanteController::class, 'index'])->name('backoffice.piernadominante.index');
Route::post('/backoffice/piernadominante', [PiernaDominanteController::class, 'store'])->name('backoffice.piernadominante.new');
Route::post('/backoffice/piernadominante/down/{_id}', [PiernaDominanteController::class, 'down'])->name('backoffice.piernadominante.down');
Route::post('/backoffice/piernadominante/up/{_id}', [PiernaDominanteController::class, 'up'])->name('backoffice.piernadominante.up');
Route::post('/backoffice/piernadominante/destroy/{_id}', [PiernaDominanteController::class, 'destroy'])->name('backoffice.piernadominante.destroy');

// Justin Kooyip
Route::get('/backoffice/mediocontacto', [MedioContactoController::class, 'index'])->name('backoffice.mediocontacto.index');
Route::post('/backoffice/mediocontacto', [MedioContactoController::class, 'store'])->name('backoffice.mediocontacto.new');
Route::post('/backoffice/mediocontacto/down/{_id}', [MedioContactoController::class, 'down'])->name('backoffice.mediocontacto.down');
Route::post('/backoffice/mediocontacto/up/{_id}', [MedioContactoController::class, 'up'])->name('backoffice.mediocontacto.up');
Route::post('/backoffice/mediocontacto/destroy/{_id}', [MedioContactoController::class, 'destroy'])->name('backoffice.mediocontacto.destroy');

// Malcolm Bahamondes

// Justin
Route::get('/backoffice/aside', [AsideController::class, 'index'])->name('backoffice.aside.index');
Route::post('/backoffice/aside', [AsideController::class, 'store'])->name('backoffice.aside.new');
Route::post('/backoffice/aside/down/{_id}', [AsideController::class, 'down'])->name('backoffice.aside.down');
Route::post('/backoffice/aside/up/{_id}', [AsideController::class, 'up'])->name('backoffice.aside.up');
Route::post('/backoffice/aside/destroy/{_id}', [AsideController::class, 'destroy'])->name('backoffice.aside.destroy');


// Jugadores: Paula, Indira, Javiera

Route::get('/backoffice/jugadores', [JugadoresController::class, 'index'])->name('backoffice.jugadores.index');
Route::post('/backoffice/jugadores', [JugadoresController::class, 'store'])->name('backoffice.jugadores.new');
Route::post('/backoffice/jugadores/down/{_id}', [JugadoresController::class, 'down'])->name('backoffice.jugadores.down');
Route::post('/backoffice/jugadores/up/{_id}', [JugadoresController::class, 'up'])->name('backoffice.jugadores.up');
Route::post('/backoffice/jugadores/destroy/{_id}', [JugadoresController::class, 'destroy'])->name('backoffice.jugadores.destroy');


//Entrenamientos: Miguel, Justin, Malcolm

Route::get('/backoffice/entrenamiento', [EntrenamientosController::class, 'index'])->name('backoffice.entrenamiento.index');
Route::post('/backoffice/entrenamiento', [EntrenamientosController::class, 'store'])->name('backoffice.entrenamiento.new');
Route::post('/backoffice/entrenamiento/down/{_id}', [EntrenamientosController::class, 'down'])->name('backoffice.entrenamiento.down');
Route::post('/backoffice/entrenamiento/up/{_id}', [EntrenamientosController::class, 'up'])->name('backoffice.entrenamiento.up');
Route::post('/backoffice/entrenamiento/destroy/{_id}', [EntrenamientosController::class, 'destroy'])->name('backoffice.entrenamiento.destroy');

// Medios de contacto: Hector + Ethan

// Ruta para actualizar datos personales del usuario
Route::put('/backoffice/user/contact', [UserController::class, 'updateContacto'])
    ->name('backoffice.user.contact.update');

// Equipos: Luciano, JP y Gerald

Route::get('/backoffice/equipos', [EquiposController::class, 'index'])->name('backoffice.equipos.index');
Route::post('/backoffice/equipos', [EquiposController::class, 'store'])->name('backoffice.equipos.new');
Route::post('/backoffice/equipos/down/{_id}', [EquiposController::class, 'down'])->name('backoffice.equipos.down');
Route::post('/backoffice/equipos/up/{_id}', [EquiposController::class, 'up'])->name('backoffice.equipos.up');
Route::post('/backoffice/equipos/destroy/{_id}', [EquiposController::class, 'destroy'])->name('backoffice.equipos.destroy');

Route::get('/backoffice/equipo-jugador', [EquipoJugadorController::class, 'index'])->name('backoffice.equipo-jugador.index');
Route::post('/backoffice/equipo-jugador', [EquipoJugadorController::class, 'store'])->name('backoffice.equipo-jugador.new');
Route::post('/backoffice/equipo-jugador/down/{_id}', [EquipoJugadorController::class, 'down'])->name('backoffice.equipo-jugador.down');
Route::post('/backoffice/equipo-jugador/up/{_id}', [EquipoJugadorController::class, 'up'])->name('backoffice.equipo-jugador.up');
Route::post('/backoffice/equipo-jugador/destroy/{_id}', [EquipoJugadorController::class, 'destroy'])->name('backoffice.equipo-jugador.destroy');

// Desarrollador: Santos y Robert
Route::get('/backoffice/desarrollador', [DesarrolladorController::class, 'index'])->name('backoffice.desarrollador.index');
Route::post('/backoffice/desarrollador', [DesarrolladorController::class, 'store'])->name('backoffice.desarrollador.new');
Route::delete('/backoffice/desarrollador/down/{_id}', [DesarrolladorController::class, 'down'])->name('backoffice.desarrollador.down');
Route::post('/backoffice/desarrollador/up/{_id}', [DesarrolladorController::class, 'up'])->name('backoffice.desarrollador.up');
Route::delete('/backoffice/desarrollador/destroy/{_id}', [DesarrolladorController::class, 'destroy'])->name('backoffice.desarrollador.destroy');

// Estadopago: Malcolm
Route::get('/backoffice/estadopago', [EstadosPagoController::class, 'index'])->name('backoffice.estadospago.index');
Route::post('/backoffice/estadopago/new', [EstadosPagoController::class, 'crearEstado'])->name('backoffice.estadospago.new');
Route::post('/backoffice/estadopago/new', [EstadosPagoController::class, 'store'])->name('backoffice.estadospago.new');
Route::post('/backoffice/estadopago/up/{id}', [EstadosPagoController::class, 'up'])->name('backoffice.estadospago.up');
Route::post('/backoffice/estadopago/down/{id}', [EstadosPagoController::class, 'down'])->name('backoffice.estadospago.down');
Route::post('/backoffice/estadopago/destroy/{id}', [EstadosPagoController::class, 'destroy'])->name('backoffice.estadospago.destroy');
// EstadoEntrenamiento : Malcolm
Route::get('/backoffice/estadosentrenamiento', [EstadosEntrenamientoController::class, 'index'])->name('backoffice.estadosentrenamiento.index');
Route::post('/backoffice/estadosentrenamiento', [EstadosEntrenamientoController::class, 'store'])->name('backoffice.estadosentrenamiento.new');
Route::post('/backoffice/estadosentrenamiento/up/{id}', [EstadosEntrenamientoController::class, 'up'])->name('backoffice.estadosentrenamiento.up');
Route::post('/backoffice/estadosentrenamiento/down/{id}', [EstadosEntrenamientoController::class, 'down'])->name('backoffice.estadosentrenamiento.down');
Route::post('/backoffice/estadosentrenamiento/destroy/{id}', [EstadosEntrenamientoController::class, 'destroy'])->name('backoffice.estadosentrenamiento.destroy');
//Tipos de Partido: Miguel
Route::get('/backoffice/tipopartido', [TipoPartidoController::class, 'index'])->name('backoffice.tipopartido.index');
Route::post('/backoffice/tipopartido', [TipoPartidoController::class, 'store'])->name('backoffice.tipopartido.new');
Route::post('/backoffice/tipopartido/up/{id}', [TipoPartidoController::class, 'up'])->name('backoffice.tipopartido.up');
Route::post('/backoffice/tipopartido/down/{id}', [TipoPartidoController::class, 'down'])->name('backoffice.tipopartido.down');
Route::post('/backoffice/tipopartido/destroy/{id}', [TipoPartidoController::class, 'destroy'])->name('backoffice.tipopartido.destroy');

// Rutas agregadas para jugadores del mes: Javi, Indira, Paula
// Rutas para Jugador del Mes (solo lo necesario por ahora)
Route::get('/backoffice/jugadorDelMes', [JugadorDelMesController::class, 'index'])
    ->name('backoffice.jugadorDelMes.index');
Route::post('/backoffice/jugadorDelMes', [JugadorDelMesController::class, 'storeDestacado'])
    ->name('backoffice.jugadorDelMes.new');
Route::post('/backoffice/jugadorDelMes/down/{_id}', [JugadorDelMesController::class, 'down'])->name('backoffice.jugadorDelMes.down');
Route::post('/backoffice/jugadorDelMes/up/{_id}', [JugadorDelMesController::class, 'up'])->name('backoffice.jugadorDelMes.up');
Route::post('/backoffice/jugadorDelMes/destroy/{_id}', [JugadorDelMesController::class, 'destroy'])->name('backoffice.jugadorDelMes.destroy');
