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
        // Route::post('/register', 'AuthController@register');
        Route::get('/me', 'AuthController@me');
        Route::get('/logout', 'AuthController@logout');
    }
);
Route::group([
    'prefix' => 'users',
    'namespace' => 'User'
    ], function () {
        Route::post('/register', 'UserController@store');
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show');
        Route::post('/{id}', 'UserController@update');
        Route::get('/get/roles', 'UserController@getRole');
    }
);
Route::group([
    'prefix' => 'activities',
    'middleware' => ['auth.jwt'],
    'namespace' => 'Activities'
    ], function () {
        Route::get('/', 'ActivitiesController@index');
        Route::get('/dashboard/data', 'ActivitiesController@dashboardData');
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