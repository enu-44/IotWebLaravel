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



Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ROUTES PROFILE USER
/*---------------------------------------------------------------*/
Route::group(['profile' => 'profile','as'=>'profile.'], function(){
    $controller = 'UserProfileController@';

    Route::get('/profile_user', ['as' => 'profile', 'uses' => $controller.'getProfile']);

    Route::post('/update_profile', ['as' => 'update_profile', 'uses' => $controller.'postChangeImageProfile']);
   // Route::get('reser', ['uses' => $controller.'getIndex', 'as' => 'reservas']);
});




//ROUTES TIPO PROYECTOS
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'TipoProyectosController@';
    
    Route::get('/tipoproyectos', ['as' => 'tipoproyectos', 'uses' => $controller.'getTipoProyectos']);

    Route::post('/tipoproyectos', ['as' => 'tipoproyectos', 'uses' => $controller.'postTipoProyectos']);

    Route::post('/deletetipoproyectos', ['as' => 'tipoproyectos', 'uses' => $controller.'postDeleteTipoProyectos']);
});





//ROUTES TIPO DISPOSITIVOS
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'TipoDispositivoController@';
    
    Route::get('/tipodispositivos', ['as' => 'tipodispositivos', 'uses' => $controller.'getTipoDispositivos']);

    Route::post('/tipodispositivos', ['as' => 'tipodispositivos', 'uses' => $controller.'postTipoDispositivos']);

    Route::post('/deletetipodispositivos', ['as' => 'deletetipodispositivos', 'uses' => $controller.'postDeleteTipoDispositivos']);
});




//ROUTES TIPO VARIABLES
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'TipoVariableController@';
    
    Route::get('/tipovariables', ['as' => 'tipovariables', 'uses' => $controller.'getTipoVariable']);

    Route::post('/tipovariables', ['as' => 'tipovariables', 'uses' => $controller.'postTipoVariable']);

    Route::post('/deletetipovariable', ['as' => 'deletetipovariable', 'uses' => $controller.'postDeleteTipoVariable']);
});






//ROUTES PROYECTOS
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'ProyectoController@';
    
    Route::get('/proyectos', ['as' => 'proyectos', 'uses' => $controller.'getProyectos']);

    Route::post('/proyectos', ['as' => 'proyectos', 'uses' => $controller.'postProyectos']);

    Route::post('/deleteproyecto', ['as' => 'deleteproyecto', 'uses' => $controller.'postDeleteProyecto']);
});
    


//ROUTES PROYECTOS
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'UnidadProductivaController@';
    
    Route::get('/unidades_productivas', ['as' => 'unidades_productivas', 'uses' => $controller.'getUnidadProductiva']);



    Route::get('/add_unidad_productiva', ['as' => 'add_unidad_productiva', 'uses' => $controller.'getAddUnidadProductiva']);

    /*Route::post('/unidades_productivas', ['as' => 'unidades_productivas', 'uses' => $controller.'postProyectos']);

    Route::post('/deleteunidadesproductivas', ['as' => 'deleteunidadesproductivas', 'uses' => $controller.'postDeleteUnidadesProductivas']);
    */
});
    



