<?php

use Illuminate\Support\Facades\Route;
use Uasoft\Badaso\Middleware\ApiRequest;
use Uasoft\Badaso\Middleware\BadasoCheckPermissions;
use Uasoft\Badaso\Module\Content\Helpers\Route as HelpersRoute;

$api_route_prefix = \config('badaso.api_route_prefix');

Route::group(
    [
        'prefix' => $api_route_prefix,
        'as' => 'badaso.',
        'middleware' => [ApiRequest::class],
    ],
    function () {
        Route::group(['prefix' => 'module/content/v1'], function () {
            Route::group(['prefix' => 'content'], function () {
                Route::get('/', HelpersRoute::getController('ContentController@browse'))->middleware(BadasoCheckPermissions::class.':browse_content');
                Route::get('/read', HelpersRoute::getController('ContentController@read'))->middleware(BadasoCheckPermissions::class.':read_content');
                Route::get('/fetch', HelpersRoute::getController('ContentController@fetch'));
                Route::get('/fetch-multiple', HelpersRoute::getController('ContentController@fetchMultiple'));
                Route::post('/add', HelpersRoute::getController('ContentController@add'))->middleware(BadasoCheckPermissions::class.':add_content');
                Route::put('/fill', HelpersRoute::getController('ContentController@fill'))->middleware(BadasoCheckPermissions::class.':fill_content');
                Route::put('/edit', HelpersRoute::getController('ContentController@edit'))->middleware(BadasoCheckPermissions::class.':edit_content');
                Route::delete('/delete', HelpersRoute::getController('ContentController@delete'))->middleware(BadasoCheckPermissions::class.':delete_content');
                Route::delete('/delete-multiple', HelpersRoute::getController('ContentController@deleteMultiple'))->middleware(BadasoCheckPermissions::class.':delete_content');
            });
        });
    }
);
