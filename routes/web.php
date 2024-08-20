<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/', 'HomeController@redirectAdmin')->name('index');
// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/evento/25', 'Frontend\EventoController@index')->name('evento.show');
// Route::post('/evento/inscripcion', 'Frontend\EventoController@storeParticipante')->name('evento.storeParticipante');

Route::post('/evento/inscripcion', 'Frontend\EventoController@storeParticipante')->name('evento.storeParticipantes');
Route::get('evento/comprobanteParticipante/{parametros}', 'Frontend\EventoController@comprobanteParticipante')->name('evento.comprobanteParticipante');
Route::get('evento/comprobanteParticipantePdf/{parametros}', 'Frontend\EventoController@comprobanteParticipantePdf')->name('evento.comprobanteParticipantePdf');

// Route::get('/evento/25', 'Frontend\EventoController@index')->name('evento.show');
Route::get('/evento/26', 'Frontend\EventoController@show')->name('evento.show');

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'programa', 'controller' => 'Frontend\ProgramaController'], function () {
    Route::get('/', 'index')->name('programa');
    Route::get('/{pro_id}', 'show')->name('programa.show');
});

Route::group(['prefix' => 'evento', 'controller' => 'Frontend\EventoController'], function () {
    Route::get('/', 'eventos')->name('evento');
    Route::get('/detalle/{eve_id}', 'detalle')->name('eventoDetalle');
    Route::get('/{eve_id}', 'evento')->name('evento.show');
});

Route::group(['prefix' => 'blog', 'controller' => 'Frontend\BlogController'], function () {
    Route::get('/', 'index')->name('blog');
    Route::get('/{blog_id}', 'show')->name('blog.show');
});

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);
    Route::resource('profe', 'Backend\ProfeController', ['names' => 'admin.profe']);
    Route::resource('responsable', 'Backend\ResponsableController', ['names' => 'admin.responsable']);
    Route::resource('programa', 'Backend\ProgramaController', ['names' => 'admin.programa']);
    Route::resource('evento', 'Backend\EventoController', ['names' => 'admin.evento']);
    Route::resource('blog', 'Backend\BlogController', ['names' => 'admin.blog']);
    Route::resource('galeria', 'Backend\GaleriaController', ['names' => 'admin.galeria']);
    Route::resource('comunicado', 'Backend\ComunicadoController', ['names' => 'admin.comunicado']);
    Route::resource('inscripcion', 'Backend\InscripcionController', ['names' => 'admin.inscripcion']);
    Route::get('inscripcionIn/{sede_id}', 'Backend\InscripcionController@index')->name('admin.inscripcion.index');
    Route::get('inscripcionI/{sede_id}', 'Backend\InscripcionController@create')->name('admin.inscripcion.create');
    Route::get('inscripcionbuscar', 'Backend\InscripcionController@buscadorPersona')->name('admin.inscripcion.buscadorpersona');
    Route::get('inscripcionbuscadorper', 'Backend\InscripcionController@buscadorPersona2')->name('admin.inscripcion.buscadorper');
    // Route::get('inscripcion/{sede_id}', 'Backend\InscripcionController@indexSede', ['names' => 'admin.inscripcion.indexsede']);
    Route::resource('sede', 'Backend\SedeController', ['names' => 'admin.sede']);

    // Estados
    Route::get('responsable/estado/{resp_profe_id}', 'Backend\ResponsableController@estado')->name('admin.responsable.estado');
    Route::get('programa/estado/{pro_id}', 'Backend\ProgramaController@estado')->name('admin.programa.estado');
    Route::get('evento/estado/{eve_id}', 'Backend\EventoController@estado')->name('admin.evento.estado');
    Route::get('blog/estado/{blog_id}', 'Backend\BlogController@estado')->name('admin.blog.estado');
    Route::get('galeria/estado/{gal_id}', 'Backend\GaleriaController@estado')->name('admin.galeria.estado');
    Route::get('comunicado/estado/{comun_id}', 'Backend\ComunicadoController@estado')->name('admin.comunicado.estado');

    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    Route::post('/baucherpost/{id}', 'Backend\InscripcionController@baucherpost')->name('admin.inscripcion.baucherpost');
    Route::put('/baucherupdate/{pi_id}/{pro_bau_id}', 'Backend\InscripcionController@baucherupdate')->name('admin.inscripcion.baucherupdate');

    Route::get('/searchrda', 'Backend\AdminsController@searchRda')->name('admin.search.rda');
    Route::get('/search-rda', 'Backend\InscripcionController@searchRda')->name('admin.searchInscripcion.rda');
    Route::get('/get-turnos', 'Backend\InscripcionController@getTurnos')->name('admin.search.turnos');
    Route::get('/formularioPdf/{pi_id}', 'Backend\InscripcionController@formularioPdf')->name('admin.inscripcion.formulariopdf');
    Route::get('/inscripcionPdf/{pi_id}', 'Backend\InscripcionController@inscripcionPdf')->name('admin.inscripcion.inscripcionpdf');
});

Route::group(['prefix' => 'configuracion'], function () {
    Route::resource('programa', 'Configuracion\ProgramaController', ['names' => 'configuracion.programa']);
    Route::resource('restriccion', 'Configuracion\RestriccionController', ['names' => 'configuracion.restriccion']);

    Route::post('storeversion', 'Configuracion\ProgramaController@storeVersion')->name('configuracion.programa.storeversion');
    Route::post('updateversion/{pv_id}', 'Configuracion\ProgramaController@updateVersion')->name('configuracion.programa.updateversion');
    Route::delete('deleteversion/{pv_id}', 'Configuracion\ProgramaController@destroyVersion')->name('configuracion.programa.deleteversion');

    Route::post('storetipo', 'Configuracion\ProgramaController@storeTipo')->name('configuracion.programa.storetipo');
    Route::post('storeturno', 'Configuracion\ProgramaController@storeTurno')->name('configuracion.programa.storeturno');
    Route::post('storeduracion', 'Configuracion\ProgramaController@storeDuracion')->name('configuracion.programa.storeduracion');
    Route::post('storemodalidad', 'Configuracion\ProgramaController@storeModalidad')->name('configuracion.programa.storemodalidad');

    Route::resource('sede', 'Configuracion\SedeController', ['names' => 'configuracion.sede']);

    Route::resource('evento', 'Configuracion\EventoController', ['names' => 'configuracion.evento']);
});

Route::group(['prefix' => 'migration'], function () {
    Route::post('areatrabajo', 'Migration\OtrosController@areaTrabajo')->name('migration.otros.areatrabajo');
    Route::post('nivel', 'Migration\OtrosController@nivel')->name('migration.otros.nivel');
    Route::post('categoria', 'Migration\OtrosController@categoria')->name('migration.otros.categoria');
    Route::post('subsistema', 'Migration\OtrosController@subsistema')->name('migration.otros.subsistema');

    // MIGRACIONES--------------------------------------------------------------------------------------------------------------------------
    Route::resource('usuarios', 'Migration\UsuariosController', ['names' => 'migration.usuarios']);
    Route::resource('inscripciones', 'Migration\ProgramaInscripcionController', ['names' => 'migration.inscripciones']);
    Route::resource('otros', 'Migration\OtrosController', ['names' => 'migration.otros']);
    Route::resource('cargo', 'Migration\CargoController', ['names' => 'migration.cargo']);
    Route::resource('especialidad', 'Migration\EspecialidadController', ['names' => 'migration.especialidad']);
    Route::resource('departamento', 'Migration\DepartamentoController', ['names' => 'migration.departamento']);
    Route::resource('distrito', 'Migration\DistritoController', ['names' => 'migration.distrito']);
    Route::resource('unidadeducativa', 'Migration\UnidadEducativaController', ['names' => 'migration.unidadeducativa']);
});
