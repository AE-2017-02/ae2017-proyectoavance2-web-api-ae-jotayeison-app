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
/**
 * CITAS
 */
$router->get('getCitas','CitaController@getCitas');
$router->get('getCitasEntre','CitaController@getCitasBetween');
$router->post('insertCita','CitaController@insert');
$router->post('cancelCita','CitaController@cancel');
$router->post('updateCita','CitaController@update');
$router->post('deleteCita','CitaController@delete');

/**
 * RESUMEN CITAS
 */
$router->get('getResumenCitas','ResumenCitaController@getResumenCitas');
$router->post('insertResumenCita','ResumenCitaController@insert');

/**
 * EXPEDIENTE
 */
$router->get('getExpediente','ExpedienteController@getExpediente');
