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

$router->get('login','Configuracion@login');

$router->post('setConfig','Configuracion@setConfig');

$router->get('getConfig','Configuracion@getConfig');

$router->post('changePassword','Configuracion@changePassword');

/*
 *      PRE-REGISTRO DEL PACIENTE
 * */

$router->post('setPreRegistro','PacienteController@preRegistro');

$router->get('getPreRegistros','PacienteController@getPreRegistros');

$router->post('setEstadoRegistro','PacienteController@estadoRegistro');

