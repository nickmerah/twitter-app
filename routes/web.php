<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;



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
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->post('subscribe', ['uses' => 'SubscribeController@subscribe']);
    $router->post('subscribe-channel', ['uses' => 'ChannelController@subscribeToChannel']);
    $router->post('send-message', ['uses' => 'MessageController@sendMessage']);
    $router->post('webhook', ['uses' => 'WebhookController@handleWebhook']);
});
