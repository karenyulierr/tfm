<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
/** Inicio */
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/meet_rivera', function () {
    return view('meet_rivera');
});
Route::get('/tourist_plans', function () {
    return view('tourist_plans');
});
/**Fin inicio */

//Route::get('/', 'Auth\LoginController@showLoginForm');

//Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function () {

    Route::view('/home', 'home')->name('home');
    Route::view('/prueba', 'home')->name('prueba');
    Route::view('/user', 'home')->name('user');
    //Users
    Route::resource('/users-resource', 'UserController');
    Route::get('/getUserPermission/{id}', 'PermissionController@getUserPermission')->name('getUserPermission');
    Route::post('/updateUserPermission/{id}', 'PermissionController@updateUserPermission')->name('updateUserPermission');
    Route::post('/updateStateUser', 'UserController@updateStateUser')->name('updateStateUser');
    //Roles
    Route::view('/roles', 'home')->name('roles');
    Route::get('/getRoles', 'PermissionController@index')->name('getRoles');
    Route::get('/getAllPermission', 'PermissionController@getAllPermission')->name('getPermissions');
    Route::post('/setRole', 'PermissionController@store')->name('getPermissions');
    Route::get('/getPermissionsRole/{id}', 'RoleController@getPermissionsRole')->name('getPermissionsRole');
    Route::post('/updateRole/{id}', 'RoleController@update')->name('updateRole');
    //Categorias
    Route::view('/category', 'home')->name('category');
    Route::resource('/category-resource','CategoryController');
    //Servicios
    Route::view('/service', 'home')->name('service');
    Route::resource('/service-resource','ServiceController');
    //Sitios turísticos
    Route::resource('/tourist-site-resource','TouristSiteController');
    //Reglas
    Route::view('/rule', 'home')->name('rule');
    Route::resource('/rule-resource','RuleController');
    //Reglas
    Route::view('/serviceSite', 'home')->name('serviceSite');
    Route::resource('/service-site-resource','ServiceSiteController');

});
