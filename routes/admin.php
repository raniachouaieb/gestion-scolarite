<?php

use Illuminate\Support\Facades\Route;
define('PAGINATION', 3);

Route::group(['namespace'=>'Dashboard'],function(){
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('getLogin', 'LoginController@getLogin')->name('admin.getLogin');
});



Route::get('accueil', 'Dashboard\AdminController@index')->name('accueil');
Route::post('logout', 'Dashboard\AdminController@logout')->name('logouteff');

Route::group(['namespace'=>'Dashboard','prefix' => 'levels'],function(){
    Route::get('/', 'LevelController@index')->name('levels.index');
    Route::get('show/{id}', 'LevelController@show');
    Route::get('addLevel', 'LevelController@addLevel')->name('levels.add');
    Route::post('store', 'LevelController@store')->name('levels.store');
    Route::get('edit/{id}', 'LevelController@edit')->name('levels.edit');
    Route::patch('update/{id}', 'LevelController@update')->name('levels.update');
    Route::delete('delete/{id}', 'LevelController@destroy')->name('levels.destroy');
});

Route::group(['namespace'=>'Dashboard','prefix' => 'classes/'],function(){
    Route::get('/', 'ClassroomController@index')->name('classes.index');
    Route::get('show/{id}', 'ClassroomController@show');
    Route::get('addClass', 'ClassroomController@addClass')->name('classes.add');
    Route::post('store', 'ClassroomController@store')->name('classes.store');
    Route::get('edit/{id}', 'ClassroomController@edit')->name('classes.edit');
    Route::post('update/{id}', 'ClassroomController@update')->name('classes.update');
    Route::delete('delete/{id}', 'ClassroomController@destroy')->name('classes.destroy');
});

Route::group(['namespace'=>'Dashboard','prefix' => 'matieres/'],function(){
    Route::get('/', 'MatiereController@index')->name('matieres.index');
    Route::get('addMatiere', 'MatiereController@addMatiere')->name('matieres.add');
    Route::post('storeMatiere', 'MatiereController@store')->name('matieres.storeMatiere');
    Route::get('edit/{id}', 'MatiereController@edit')->name('matieres.edit');
    Route::post('update/{id}', 'MatiereController@update')->name('matieres.update');
    Route::delete('delete/{id}', 'MatiereController@destroy')->name('matieres.destroy');

});

Route::group(['namespace'=>'Dashboard','prefix' => 'modules/'],function(){
    Route::get('/', 'ModuleController@index')->name('modules.index');
    Route::get('show/{id}', 'ModuleController@show')->name('modules.show');
    Route::get('addModule', 'ModuleController@addModule')->name('modules.add');
    Route::post('storeModule', 'ModuleController@store')->name('modules.storeModule');
    Route::get('edit/{id}', 'ModuleController@edit')->name('modules.edit');
    Route::post('update/{id}', 'ModuleController@update')->name('modules.update');
    Route::delete('delete/{id}', 'ModuleController@destroy')->name('modules.destroy');
});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'convocations/'], function(){
    Route::get('/', 'ConvocationController@index')->name('convocations.index');
    Route::get('addConv', 'ConvocationController@addConv')->name('convocations.addConv');
    Route::post('storeConv', 'ConvocationController@store')->name('convocations.storeConv');
    Route::get('editConv/{id}', 'ConvocationController@edit')->name('convocations.editConv');
    Route::post('updateConv/{id}', 'ConvocationController@update')->name('convocations.updateConv');
    Route::delete('delete/{id}', 'ConvocationController@destroy')->name('convocations.destroy');
    Route::get('getClasse', 'ConvocationController@getClasse')->name('convocations.getClasse');
    Route::get('getEleve', 'ConvocationController@getEleve')->name('convocations.getEleve');
    Route::delete('delete/{id}', 'ConvocationController@destroy')->name('convocations.destroy');


});

Route::group([ 'namespace'=>'Dashboard', 'prefix'=> 'menus/'], function(){
    Route::get('/', 'MenuController@index')->name('menu.index');
    Route::get('addMenu', 'MenuController@addMenu')->name('menu.addMenu');
    Route::post('storeMenu', 'MenuController@store')->name('menu.storeMenu');
    Route::get('editMenu/{id}', 'MenuController@edit')->name('menu.editMenu');
    Route::post('updateMenu/{id}', 'MenuController@update')->name('menu.updateMenu');
});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'Travails/'], function(){
    Route::get('/', 'TravailController@index')->name('travails.index');
    Route::get('addTravail', 'TravailController@add')->name('travails.addTravail');
    Route::post('storeTravail', 'TravailController@store')->name('travails.storeTravail');
    Route::get('editTravail/{id}', 'TravailController@edit')->name('travails.editTravail');
    Route::post('updateTravail/{id}', 'TravailController@update')->name('travails.updateTravail');
    Route::delete('delete/{id}', 'TravailController@destroy')->name('travails.destroy');
    Route::get('getClasse', 'TravailController@getClasse')->name('travails.getClasse');



});



Route::group(['namespace'=>'Dashboard','prefix' => 'inscri/'],function(){
    Route::get('/', 'ParentController@index')->name('inscri.index');
    Route::get('/list_accepted', 'ParentController@listAccepted')->name('inscri.list_accepted');

    Route::get('edit/{id}', 'ParentController@edit')->name('isncri.edit');
    Route::post('update/{id}', 'ParentController@update')->name('inscri.update');
    Route::post('updateEleve/{id}', 'ParentController@updateEleve')->name('inscri.updateEleve');
    Route::get('changeStatus/{id}', 'ParentController@changeStatus')->name('inscri.chagestatus');
    Route::get('parentByClass', 'ParentController@parentByClass')->name('inscri.parentByClass');
    Route::get('getClasse', 'ParentController@getClasse')->name('inscri.getClasse');





});
Route::group(['namespace'=>'Dashboard','prefix' => 'student/'],function(){
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::get('eleveByClass', 'StudentController@eleveByClass')->name('student.eleveByClass');
    Route::get('edit\{id}', 'StudentController@edit')->name('student.edit');
    Route::post('update\{id}', 'StudentController@update')->name('student.update');
    Route::get('getClasse', 'StudentController@getClasse')->name('student.getClasse');
    Route::get('elevePreInscrit','StudentController@elevePreInscrit')->name('student.elevePreInscrit');






});



//Route::get('/home', 'HomeController@index')->name('home');

