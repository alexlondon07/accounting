<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', 'HomeController@showWelcome');
Route::get('login', 'UserController@login');
Route::post('login', 'UserController@doLogin');
Route::any('logout', 'UserController@doLogout');
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {
    Route::get('/', 'HomeController@showWelcome');
    Route::get('main', 'HomeController@showMain');
    Route::resource('user', 'UserController');
    Route::get('users/search', 'UserController@search');
    Route::resource('client', 'ClientController');
    Route::get('clients/search', 'ClientController@search');
    Route::resource('provider', 'ProviderController');
    Route::get('providers/search', 'ProviderController@search');
    Route::resource('location', 'LocationController');
    Route::get('locations/search', 'LocationController@search');
    Route::resource('machine', 'MachineController');
    Route::get('machines/search', 'MachineController@search');
    Route::resource('supply', 'SupplyController');
    Route::get('supplys/search', 'SupplyController@search');
    Route::resource('frame', 'FrameController');
    Route::get('frames/search', 'FrameController@search');
    Route::resource('inkmix', 'InkmixController');
    Route::get('inkmixs/search', 'InkmixController@search');
    Route::resource('reference', 'ReferenceController');
    Route::get('references/search', 'ReferenceController@search');
    Route::resource('kit', 'KitController');
    Route::get('kits/search', 'KitController@search');
    Route::resource('requisition', 'RequisitionController');
    Route::get('requisitions/search', 'RequisitionController@search');
    Route::resource('order', 'OrderController');
    Route::get('orders/search', 'OrderController@search');
});

// llamados ajax
Route::group(array('prefix' => 'ajax'), function() {
    Route::any('usernameexist', 'UserController@userNameExist');
    // llamados ajax que requieren autenticacion
    Route::group(array('before' => 'auth'), function() {
        // FUNCIONES QUE REQUIEREN AUTENTICACION
    });
});


/*
 * Ruta para identificar el host donde se esta ejecutando al aplicacion
 */
Route::get('host', function() {
    echo gethostname();
    $app = new Illuminate\Foundation\Application;
    $env = $app->detectEnvironment(array(
        'local' => array('localhost', 'MacBook-Pro-de-Alexander.local', 'localhost', 'ALEX-PC'),
        'production' => array('pendiente'),
    ));
    echo " ___ " . $env;
});
