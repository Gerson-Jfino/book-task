<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'users',
    'namespace' => 'Auth'
    ], function () {
        Route::post('/login', 'AuthController@login');
    }
);
Route::group([
    'prefix' => 'activities',
    'namespace' => 'Activities'
    ], function () {
        Route::get('/', 'ActivitiesController@index');
        Route::get('/{id}', 'ActivitiesController@show');
        Route::delete('/{id}', 'ActivitiesController@remove');
        Route::post('/', 'ActivitiesController@store');
        Route::match(['put', 'post'], '/update/{id}', 'ActivitiesController@update');
    }
);
Route::group([
    'prefix' => 'status',
    'namespace' => 'Activities'
    ], function () {
        Route::get('/', 'ActivitiesController@indexStatus');
    }
);