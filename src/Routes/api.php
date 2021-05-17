<?php

use Uasoft\Badaso\Middleware\ApiRequest;
use Uasoft\Badaso\Middleware\BadasoCheckPermissions;

$api_route_prefix = \config('badaso.api_route_prefix');

Route::group([
    'prefix' => $api_route_prefix,
    'namespace' => 'Uasoft\Badaso\Module\Content\Controllers',
    'as' => 'badaso.',
    'middleware' => [ApiRequest::class],
],
    function () {
        Route::group(['prefix' => 'v1/module'], function () {
            Route::group(['prefix' => 'content'], function () {
                Route::get('/', 'ContentController@browse')->middleware(BadasoCheckPermissions::class.':browse_content');
                Route::get('/read', 'ContentController@read')->middleware(BadasoCheckPermissions::class.':read_content');
                Route::get('/fetch', 'ContentController@fetch');
                Route::get('/fetch-multiple', 'ContentController@fetchMultiple');
                Route::post('/add', 'ContentController@add')->middleware(BadasoCheckPermissions::class.':add_content');
                Route::put('/fill', 'ContentController@fill')->middleware(BadasoCheckPermissions::class.':fill_content');
                Route::put('/edit', 'ContentController@edit')->middleware(BadasoCheckPermissions::class.':edit_content');
                Route::delete('/delete', 'ContentController@delete')->middleware(BadasoCheckPermissions::class.':delete_content');
                Route::delete('/delete-multiple', 'ContentController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_content');
            });
        });
    }
);
