<?php
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    #Admin Dashboard
    Route::get('dashboard', 'Admin\DashboardController@index');
    
    #Language
    Route::get('language', 'Admin\LanguageController@index');
    Route::get('language/create', 'Admin\LanguageController@getCreate');
    Route::post('language/create', 'Admin\LanguageController@postCreate');
    Route::get('language/{id}/edit', 'Admin\LanguageController@getEdit');
    Route::post('language/{id}/edit', 'Admin\LanguageController@postEdit');
    Route::get('language/{id}/delete', 'Admin\LanguageController@getDelete');
    Route::post('language/{id}/delete', 'Admin\LanguageController@postDelete');
    Route::get('language/data', 'Admin\LanguageController@data');
    Route::get('language/reorder', 'Admin\LanguageController@getReorder');

    #Departamento
    Route::get('departamento', 'Admin\DepartamentoController@index');
    Route::get('departamento/create', 'Admin\DepartamentoController@getCreate');
    Route::post('departamento/create', 'Admin\DepartamentoController@postCreate');
    Route::get('departamento/{id}/edit', 'Admin\DepartamentoController@getEdit');
    Route::post('departamento/{id}/edit', 'Admin\DepartamentoController@postEdit');
    Route::get('departamento/{id}/delete', 'Admin\DepartamentoController@getDelete');
    Route::post('departamento/{id}/delete', 'Admin\DepartamentoController@postDelete');
    Route::get('departamento/data', 'Admin\DepartamentoController@data');
    Route::get('departamento/reorder', 'Admin\DepartamentoController@getReorder');

    #News category
    Route::get('newscategory', 'Admin\ArticleCategoriesController@index');
    Route::get('newscategory/create', 'Admin\ArticleCategoriesController@getCreate');
    Route::post('newscategory/create', 'Admin\ArticleCategoriesController@postCreate');
    Route::get('newscategory/{id}/edit', 'Admin\ArticleCategoriesController@getEdit');
    Route::post('newscategory/{id}/edit', 'Admin\ArticleCategoriesController@postEdit');
    Route::get('newscategory/{id}/delete', 'Admin\ArticleCategoriesController@getDelete');
    Route::post('newscategory/{id}/delete', 'Admin\ArticleCategoriesController@postDelete');
    Route::get('newscategory/data', 'Admin\ArticleCategoriesController@data');
    Route::get('newscategory/reorder', 'Admin\ArticleCategoriesController@getReorder');

    #News
    Route::get('news', 'Admin\ArticlesController@index');
    Route::get('news/create', 'Admin\ArticlesController@getCreate');
    Route::post('news/create', 'Admin\ArticlesController@postCreate');
    Route::get('news/{id}/edit', 'Admin\ArticlesController@getEdit');
    Route::post('news/{id}/edit', 'Admin\ArticlesController@postEdit');
    Route::get('news/{id}/delete', 'Admin\ArticlesController@getDelete');
    Route::post('news/{id}/delete', 'Admin\ArticlesController@postDelete');
    Route::get('news/data', 'Admin\ArticlesController@data');
    Route::get('news/reorder', 'Admin\ArticlesController@getReorder');

    #Photo Album
    Route::get('photoalbum', 'Admin\PhotoAlbumController@index');
    Route::get('photoalbum/create', 'Admin\PhotoAlbumController@getCreate');
    Route::post('photoalbum/create', 'Admin\PhotoAlbumController@postCreate');
    Route::get('photoalbum/{id}/edit', 'Admin\PhotoAlbumController@getEdit');
    Route::post('photoalbum/{id}/edit', 'Admin\PhotoAlbumController@postEdit');
    Route::get('photoalbum/{id}/delete', 'Admin\PhotoAlbumController@getDelete');
    Route::post('photoalbum/{id}/delete', 'Admin\PhotoAlbumController@postDelete');
    Route::get('photoalbum/data', 'Admin\PhotoAlbumController@data');
    Route::get('photoalbum/reorder', 'Admin\PhotoAlbumController@getReorder');

    #Photo
    Route::get('photo', 'Admin\PhotoController@index');
    Route::get('photo/create', 'Admin\PhotoController@getCreate');
    Route::post('photo/create', 'Admin\PhotoController@postCreate');
    Route::get('photo/{id}/edit', 'Admin\PhotoController@getEdit');
    Route::post('photo/{id}/edit', 'Admin\PhotoController@postEdit');
    Route::get('photo/{id}/delete', 'Admin\PhotoController@getDelete');
    Route::post('photo/{id}/delete', 'Admin\PhotoController@postDelete');
    Route::get('photo/{id}/itemsforalbum', 'Admin\PhotoController@itemsForAlbum');
    Route::get('photo/{id}/{id2}/slider', 'Admin\PhotoController@getSlider');
    Route::get('photo/{id}/{id2}/albumcover', 'Admin\PhotoController@getAlbumCover');
    Route::get('photo/data/{id}', 'Admin\PhotoController@data');
    Route::get('photo/reorder', 'Admin\PhotoController@getReorder');

    #Video
    Route::get('videoalbum', 'Admin\VideoAlbumController@index');
    Route::get('videoalbum/create', 'Admin\VideoAlbumController@getCreate');
    Route::post('videoalbum/create', 'Admin\VideoAlbumController@postCreate');
    Route::get('videoalbum/{id}/edit', 'Admin\VideoAlbumController@getEdit');
    Route::post('videoalbum/{id}/edit', 'Admin\VideoAlbumController@postEdit');
    Route::get('videoalbum/{id}/delete', 'Admin\VideoAlbumController@getDelete');
    Route::post('videoalbum/{id}/delete', 'Admin\VideoAlbumController@postDelete');
    Route::get('videoalbum/data', 'Admin\VideoAlbumController@data');
    Route::get('video/reorder', 'Admin\VideoAlbumController@getReorder');

    #Video
    Route::get('video', 'Admin\VideoController@index');
    Route::get('video/create', 'Admin\VideoController@getCreate');
    Route::post('video/create', 'Admin\VideoController@postCreate');
    Route::get('video/{id}/edit', 'Admin\VideoController@getEdit');
    Route::post('video/{id}/edit', 'Admin\VideoController@postEdit');
    Route::get('video/{id}/delete', 'Admin\VideoController@getDelete');
    Route::post('video/{id}/delete', 'Admin\VideoController@postDelete');
    Route::get('video/{id}/itemsforalbum', 'Admin\VideoController@itemsForAlbum');
    Route::get('video/{id}/{id2}/albumcover', 'Admin\VideoController@getAlbumCover');
    Route::get('video/data/{id}', 'Admin\VideoController@data');
    Route::get('video/reorder', 'Admin\VideoController@getReorder');

    #Grupo
    Route::get('grupo', 'Admin\GrupoController@index');
    Route::get('grupo/create', 'Admin\GrupoController@getCreate');
    Route::post('grupo/create', 'Admin\GrupoController@postCreate');
    Route::get('grupo/{id}/edit', 'Admin\GrupoController@getEdit');
    Route::post('grupo/{id}/edit', 'Admin\GrupoController@postEdit');
    Route::get('grupo/{id}/delete', 'Admin\GrupoController@getDelete');
    Route::post('grupo/{id}/delete', 'Admin\GrupoController@postDelete');
    Route::get('grupo/{id}/itemsfordepa', 'Admin\GrupoController@itemsForDepartamento');
    Route::get('grupo/{id}/{id2}/grupodepa', 'Admin\GrupoController@getDepartamentoGrupo');
    Route::get('grupo/data/{id}', 'Admin\GrupoController@data');
    Route::get('grupo/reorder', 'Admin\GrupoController@getReorder');
    


    #Clase
    Route::get('clases', 'Admin\ClaseController@index');
    Route::get('clases/create', 'Admin\ClaseController@getCreate');
    Route::post('clases/create', 'Admin\ClaseController@postCreate');
    Route::get('clases/{id}/edit', 'Admin\ClaseController@getEdit');
    Route::post('clases/{id}/edit', 'Admin\ClaseController@postEdit');
    Route::get('clases/{id}/delete', 'Admin\ClaseController@getDelete');
    Route::post('clases/{id}/delete', 'Admin\ClaseController@postDelete');
    Route::get('clases/{id}/itemsforhorario', 'Admin\ClaseController@itemsForHorario');
    Route::get('clases/data/{id}', 'Admin\ClaseController@data');
    Route::get('clases/data2/{id}', 'Admin\ClaseController@data2');
    Route::get('clases/reorder', 'Admin\ClaseController@getReorder');
    Route::get('clases/horario/{id}', 'Admin\ClaseController@data2');



    #Materia
    Route::get('materia', 'Admin\MateriaController@index');
    Route::get('materia/create', 'Admin\MateriaController@getCreate');
    Route::post('materia/create', 'Admin\MateriaController@postCreate');
    Route::get('materia/{id}/edit', 'Admin\MateriaController@getEdit');
    Route::post('materia/{id}/edit', 'Admin\MateriaController@postEdit');
    Route::get('materia/{id}/delete', 'Admin\MateriaController@getDelete');
    Route::post('materia/{id}/delete', 'Admin\MateriaController@postDelete');
    Route::get('materia/{id}/{id2}/departamento', 'Admin\MateriaController@getDepartamento');
    Route::get('materia/data/{id}', 'Admin\MateriaController@data');
    Route::get('materia/reorder', 'Admin\MateriaController@getReorder');

    #Users
    Route::get('users/', 'Admin\UserController@index');
    Route::get('users/create', 'Admin\UserController@getCreate');
    Route::post('users/create', 'Admin\UserController@postCreate');
    Route::get('users/{id}/edit', 'Admin\UserController@getEdit');
    Route::post('users/{id}/edit', 'Admin\UserController@postEdit');
    Route::get('users/{id}/delete', 'Admin\UserController@getDelete');
    Route::post('users/{id}/delete', 'Admin\UserController@postDelete');
    Route::get('users/data/{id}', 'Admin\UserController@data');
    Route::get('users/{id}/itemsforalumno', 'Admin\UserController@itemsForAlumno');

    #Maestros
    Route::get('maestros/', 'Admin\MaestroController@index');
    Route::get('maestros/create', 'Admin\MaestroController@getCreate');
    Route::post('maestros/create', 'Admin\MaestroController@postCreate');
    Route::get('maestros/{id}/edit', 'Admin\MaestroController@getEdit');
    Route::post('maestros/{id}/edit', 'Admin\MaestroController@postEdit');
    Route::get('maestros/{id}/delete', 'Admin\MaestroController@getDelete');
    Route::post('maestros/{id}/delete', 'Admin\MaestroController@postDelete');
    Route::get('maestros/data', 'Admin\MaestroController@data');

     #Padres
    Route::get('padres/', 'Admin\PadreController@index');
    Route::get('padres/create', 'Admin\PadreController@getCreate');
    Route::post('padres/create', 'Admin\PadreController@postCreate');
    Route::get('padres/{id}/edit', 'Admin\PadreController@getEdit');
    Route::post('padres/{id}/edit', 'Admin\PadreController@postEdit');
    Route::get('padres/{id}/delete', 'Admin\PadreController@getDelete');
    Route::post('padres/{id}/delete', 'Admin\PadreController@postDelete');
    Route::get('padres/data', 'Admin\PadreController@data');

    #Madres
    Route::get('madres/', 'Admin\MadreController@index');
    Route::get('madres/create', 'Admin\MadreController@getCreate');
    Route::post('madres/create', 'Admin\MadreController@postCreate');
    Route::get('madres/{id}/edit', 'Admin\MadreController@getEdit');
    Route::post('madres/{id}/edit', 'Admin\MadreController@postEdit');
    Route::get('madres/{id}/delete', 'Admin\MadreController@getDelete');
    Route::post('madres/{id}/delete', 'Admin\MadreController@postDelete');
    Route::get('madres/data', 'Admin\MadreController@data');

});
