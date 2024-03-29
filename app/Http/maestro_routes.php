<?php
Route::group(['prefix' => 'maestro', 'middleware' => 'auth'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    #Maestro Dashboard
    Route::get('dashboard2', 'Maestro\DashboardController@index');

#exam
    Route::get('exam/', 'Maestro\ExamController@index');
    Route::get('exam/create', 'Maestro\ExamController@getCreate');
    Route::post('exam/create', 'Maestro\ExamController@postCreate');
    Route::get('exam/{id}/edit', 'Maestro\ExamController@getEdit');
    Route::post('exam/{id}/edit', 'Maestro\ExamController@postEdit');
    Route::get('exam/{id}/delete', 'Maestro\ExamController@getDelete');
    Route::post('exam/{id}/delete', 'Maestro\ExamController@postDelete');
    Route::get('exam/data', 'Maestro\ExamController@data');

    #exam
    Route::get('grade/', 'Maestro\GradeController@index');
    Route::get('grade/create', 'Maestro\GradeController@getCreate');
    Route::post('grade/create', 'Maestro\GradeController@postCreate');
    Route::get('grade/{id}/edit', 'Maestro\GradeController@getEdit');
    Route::post('grade/{id}/edit', 'Maestro\GradeController@postEdit');
    Route::get('grade/{id}/delete', 'Maestro\GradeController@getDelete');
    Route::post('grade/{id}/delete', 'Maestro\GradeController@postDelete');
    Route::get('grade/data', 'Maestro\GradeController@data');

    #Notas
    Route::get('notas/', 'Maestro\NotaController@index');
    Route::get('notas/create', 'Maestro\NotaController@getCreate');
    Route::post('notas/create', 'Maestro\NotaController@postCreate');
    Route::get('notas/{id}/edit', 'Maestro\NotaController@getEdit');
    Route::post('notas/{id}/edit', 'Maestro\NotaController@postEdit');
    Route::get('notas/{id}/delete', 'Maestro\NotaController@getDelete');
    Route::post('notas/{id}/delete', 'Maestro\NotaController@postDelete');
    Route::get('notas/data', 'Maestro\NotaController@data');

    #Cvs
    Route::get('cvs/', 'Maestro\CvController@index');
    Route::get('cvs/create', 'Maestro\CvController@getCreate');
    Route::post('cvs/create', 'Maestro\CvController@postCreate');
    Route::get('cvs/{id}/edit', 'Maestro\CvController@getEdit');
    Route::post('cvs/{id}/edit', 'Maestro\CvController@postEdit');
    Route::get('cvs/{id}/delete', 'Maestro\CvController@getDelete');
    Route::post('cvs/{id}/delete', 'Maestro\CvController@postDelete');
    Route::get('cvs/data', 'Maestro\CvController@data');

    #Email
    Route::get('emails/', 'Maestro\EmailController@index');
    Route::get('emails/create', 'Maestro\EmailController@getCreate');
    Route::post('emails/create', 'Maestro\EmailController@postCreate');
    Route::get('emails/{id}/edit', 'Maestro\EmailController@getEdit');
    Route::post('emails/{id}/edit', 'Maestro\EmailController@postEdit');
    Route::get('emails/{id}/delete', 'Maestro\EmailController@getDelete');
    Route::post('emails/{id}/delete', 'Maestro\EmailController@postDelete');
    Route::get('emails/data', 'Maestro\EmailController@data');

    #Clases
    Route::get('clases/', 'Maestro\ClaseController@index');

    #Users
    Route::get('users/', 'Maestro\UserController@index');

    #Materias
    Route::get('materia/', 'Maestro\MateriaController@index');


});