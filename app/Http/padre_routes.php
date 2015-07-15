
<?php
Route::group(['prefix' => 'padre', 'middleware' => 'auth'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    #Admin Dashboard
    Route::get('pdashboard', 'Padre\DashboardController@index');
#Clases
Route::get('clases/', 'Padre\ClaseController@index');

#Users
Route::get('users/', 'Padre\UserController@index');


#Notas
Route::get('notas/', 'Padre\NotaController@index');




});