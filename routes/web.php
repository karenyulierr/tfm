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
Route::get('/', 'CategoryApiController@index')->name('welcome');
Route::get('/contact', 'CategoryApiController@contact')->name('contact');
Route::get('/meet_rivera', 'CategoryApiController@meet_rivera')->name('meet_rivera');
Route::get('/tourist_plans', 'CategoryApiController@tourist_plans')->name('tourist_plans');
Route::get('/detail_plans', 'CategoryApiController@detail_plans')->name('detail_plans');
Route::get('/categoryview', 'CategoryApiController@categoryview')->name('categoryview');

Route::get('/categoryviewdetail', 'CategoryApiController@categoryviewdetail')->name('categoryviewdetail');

Route::post('/reviewCreate', 'ReviewController@store')->name('reviewCreate');

Route::post('/contact-us', 'MailController@contact')->name('contact-us');



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
    Route::resource('/category-resource', 'CategoryController');
    //Servicios
    Route::view('/service', 'home')->name('service');
    Route::resource('/service-resource', 'ServiceController');
    //Sitios turísticos
    Route::resource('/tourist-site-resource', 'TouristSiteController');
    //Reglas
    Route::view('/rule', 'home')->name('rule');
    Route::resource('/rule-resource', 'RuleController');
    //Servicios sitio
    Route::view('/serviceSite', 'home')->name('serviceSite');
    Route::resource('/service-site-resource', 'ServiceSiteController');
    Route::get('/searchService/{id}', 'ServiceSiteController@searchService')->name('searchService');
    Route::get('/getServiceInput/{id}', 'ServiceSiteController@getServiceInput')->name('getServiceInput');
    //Imagenes sitio
    Route::view('/imageSite', 'home')->name('imageSite');
    Route::resource('/image-site-resource', 'ImgSiteController');
    //Planes turísticos
    Route::view('/plans', 'home')->name('plans');
    Route::resource('/plan-resource','PlansController');
    //Imagenes plan
    Route::view('/imagePlan', 'home')->name('imagePlan');
    Route::resource('/image-plan-resource','ImgPlanController');
    //Reseñas
    Route::view('/review', 'home')->name('review');
    Route::resource('/review-resource','ReviewController');
});
