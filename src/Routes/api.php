<?php

use Uasoft\Badaso\Middleware\ApiRequest;

$api_route_prefix = \config('badaso.api_route_prefix');

Route::group([
    'prefix' => $api_route_prefix,
    'namespace' => 'Uasoft\Badaso\Module\Content\Controllers',
    'as' => 'badaso.',
    'middleware' => [ApiRequest::class],
],
    function () {
        Route::get('/hello_world', function () {
            return 'hello world';
        });
    }
);
