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

$router->get('login','ConfiguracionController@login');

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