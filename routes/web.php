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

    Route::post('/update_info_basic', ['as' => 'update_info_basic', 'uses' => $controller.'postUserLoguedBasic']);

    Route::post('/update_info_contact', ['as' => 'update_info_contact', 'uses' => $controller.'postUserLoguedContact']);
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
    


//ROUTES UNIDAD PRODUCTIVA
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'UnidadProductivaController@';
    
    Route::get('/unidades_productivas', ['as' => 'unidades_productivas', 'uses' => $controller.'getUnidadProductiva']);



    Route::get('/add_unidad_productiva', ['as' => 'add_unidad_productiva', 'uses' => $controller.'getAddUnidadProductiva']);

    Route::get('/editUnidadProducto/{unidadproductiva_id}', ['as' => 'edit_unidad_productiva', 'uses' => $controller.'getEditUnidadProductiva']);

    Route::post('/unidades_productivas', ['as' => 'unidades_productivas', 'uses' => $controller.'postUnidadesProductivas']);

    Route::post('/deleteunidadesproductivas', ['as' => 'deleteunidadesproductivas', 'uses' => $controller.'postDeleteUnidadProductiva']);
  
});
   



//ROUTES DISPOSITIVO
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'DispositivoController@';
    
    Route::get('/dispositivos', ['as' => 'dispositivos', 'uses' => $controller.'getDispositivos']);

    Route::get('/add_dispositivos', ['as' => 'add_dispositivos', 'uses' => $controller.'getAddDispositivo']);

    Route::get('/editDispositivo/{dispositivo_id}', ['as' => 'edit_dispositivo', 'uses' => $controller.'getEditDispositivo']);

    Route::post('/dispositivos', ['as' => 'dispositivos', 'uses' => $controller.'postDispositivos']);

    Route::post('/deletedispositivos', ['as' => 'deletedispositivos', 'uses' => $controller.'postDeleteDispositivo']);

}); 




//ROUTES CONFIGURE VARIABLES
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'ConfigurarVariablesController@';
    
    Route::get('/configurarvariables', ['as' => 'configurarvariables', 'uses' => $controller.'getConfiguracionVariable']);

    Route::get('/add_configuracion_variables', ['as' => 'add_configuracion_variables', 'uses' => $controller.'getAddConfiguracionVariable']);

     Route::get('/editConfiguracionVariable/{configuracion_variable_id}', ['as' => 'edit_configuracion_variable', 'uses' => $controller.'getEditConfiguracionVariable']);

    Route::post('/configurarvariables', ['as' => 'configurarvariables', 'uses' => $controller.'postConfiguracionVariable']);



    Route::post('/deleteconfiguracionvariable', ['as' => 'deletetipovariable', 'uses' => $controller.'postDeleteConfiguracionVariable']);
  
}); 





//ROUTES GET LIST AJAX
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'AjaxController@';
    
    Route::post('/up_by_proyecto', ['as' => 'unidades_productivas', 'uses' => $controller.'postUnidadesproductivasByProyecto']);

    Route::post('/dispositivos_by_up', ['as' => 'unidades_productivas', 'uses' => $controller.'postDispositivosByIdUp']);

    Route::post('/up_by_id', ['as' => 'unidades_productivas', 'uses' => $controller.'postUnidadesproductivasById']);

    Route::post('/dispositivo_by_id', ['as' => 'dispositivos', 'uses' => $controller.'postDispositivoById']);

     Route::post('/variables_config_by_id_dispositivo', ['as' => 'variables', 'uses' => $controller.'postConfVariableByIdExternoDispositivo']);
}); 





//ROUTES GET LIST REPORTS
/*---------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {
   $controller = 'ReportVariablesController@';
    
    Route::get('/variables_real_time', ['as' => 'variables_real_time', 'uses' => $controller.'getVariablesRealTime']);

    Route::get('/historial_variables', ['as' => 'historial_variables', 'uses' => $controller.'getHistorialVariables']);

    Route::get('/report_mapa', ['as' => 'report_mapa', 'uses' => $controller.'getMapaVariables']);
}); 





