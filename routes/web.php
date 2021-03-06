<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return response()->json(
        [
            "name" => "Nutriservices",
            "type" => "API REST",
            "version" => 1.0
        ], 200
    )
    ->header('Access-Control-Allow-Origin','*')
    ->header('Content-Type', 'application/json');
});

/*
    RUTAS DEL MODULO DE CONFIGURACIONES

*/
$router->post('login','ConfiguracionController@login');
$router->post('setConfig','ConfiguracionController@setConfig');
$router->get('getConfig','ConfiguracionController@getConfig');
$router->post('changePassword','ConfiguracionController@changePassword');
$router->post('changePasswordLogin','ConfiguracionController@changePasswordLogin');
$router->get('forgot','ConfiguracionController@forgotPassword');

/*
 *      PRE-REGISTRO DEL PACIENTE
 * */
$router->post('setPreRegistro','PacienteController@preRegistro');
$router->get('getPreRegistros','PacienteController@getPreRegistros');
$router->post('setEstadoRegistro','PacienteController@estadoRegistro');
$router->get('loginPaciente','PacienteController@loginPaciente');
$router->post('setRegistro','PacienteController@registro');
$router->post('updateRegistro','PacienteController@updateRegistro');
$router->get('getPaciente','PacienteController@getPaciente');
$router->get('getPacientes','PacienteController@getPacientes');
$router->post('setMenusPaciente','PacienteController@setMenus');
$router->get('getMenusPaciente','PacienteController@getMenus');
$router->post('deletePreRegistro','PacienteController@eliminarPreRegistro');
$router->post('setEstatusPaciente','PacienteController@estadoPaciente');

$router->post('setPicture','PacienteController@setPicture');
$router->get('getPicture','PacienteController@getPicture');
$router->get('getPicturesSeg','PacienteController@getPicturesSeguimiento');
$router->post('setPicturesSeg','PacienteController@setPictureSeguimiento');

$router->post('deleteSeguimientos','PacienteController@deleteSeguimientos');
$router->post('deleteSeguimiento','PacienteController@deleteSeguimiento');

$router->get('getPacienteByCorreo','PacienteController@getPacienteByCorreo');

/*
 *      MENUS
 * */
$router->post('setMenu','MenuController@setMenu');
$router->post('setAlimento','MenuController@insertAlimento');
$router->post('deleteMenu','MenuController@eliminarMenu');
$router->post('deleteAlimento','MenuController@eliminarAlimento');
$router->post('updateAlimento','MenuController@actualizarAlimento');
$router->post('updateMenu','MenuController@actualizarMenu');
$router->get('getAlimentos','MenuController@getAlimentos');
$router->get('getMenus','MenuController@getMenus');
$router->get('getAlimentosByMenu','MenuController@getAlimentosByMenu');

$router->get('getMenusByPaciente','MenuController@getMenu');

$router->get('getMenusActivosPaciente','MenuController@getMenusUltimaCita');


/**
 * CITAS
 */
$router->get('getCitas','CitaController@getCitas');
$router->get('getCitasEntre','CitaController@getCitasBetween');
$router->post('insertCita','CitaController@insert');
$router->post('cancelCita','CitaController@cancel');
$router->post('updateCita','CitaController@update');
$router->post('deleteCita','CitaController@delete');

$router->get('getCitasByPaciente','CitaController@getCitasByPaciente');

$router->get('getHorariosByFecha','CitaController@getHorarios');
$router->get('getUltimaCita','CitaController@getLastDates');
$router->get('getSinSeguimiento','CitaController@getSinSeguimiento');


/**
 * RESUMEN CITAS
 */
$router->get('getResumenCitas','ResumenCitaController@getResumenCitas');
$router->post('insertResumenCita','ResumenCitaController@insert');
$router->post('deleteResumenCita','ResumenCitaController@delete');
$router->post('updateResumenCita','ResumenCitaController@update');
/**
 * EXPEDIENTE
 */
$router->get('getExpediente','ExpedienteController@getExpediente');
/**
 * GRUPOS ALIMENTICIOS
 */
$router->get('getGrupos','GrupoController@get');
$router->post('insertGrupo','GrupoController@insert');
$router->post('deleteGrupo','GrupoController@delete');
$router->post('updateGrupo','GrupoController@update');

/*
 *AVISOS 
 */
$router->post('insertAvisos','AvisosController@insertAvisos');
$router->get('getAvisos','AvisosController@getAvisos');

