<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|-------------------------------------------
| API's Endpoints
|-------------------------------------------
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
	$api->get('sync/github', 'App\Http\Controllers\Api\V1\SyncController@getAllRepos');
    $api->post('auth/github', 'App\Http\Controllers\Api\V1\AuthenticateController@authenticate');
    $api->get('auth/user', 'App\Http\Controllers\Api\V1\AuthenticateController@getAuthenticatedUser');
});

/*
|------------------------------------------
| Main Routes
|------------------------------------------
*/

Route::get('/', function () {
    return view('index');
});
