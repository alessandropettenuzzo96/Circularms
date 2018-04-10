<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Navigable;
use \App\Settings;

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/admin', 'AdminController@index')->name('admin');

Settings::webRoutes();

Route::resource('users', 'UserController');

Route::get('/', [
    'as'      => 'home',
    'uses'    => 'NavigationController@index'
]);


Navigable::register('WEB');

//Route::get('{slug}', [
//    'uses' => 'PageController@getPage'
//])->where('slug', '([A-Za-z0-9\-\/]+)');

