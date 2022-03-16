<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Dashboard'],function(){
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('getLogin', 'LoginController@getLogin')->name('admin.getLogin');
});



Route::get('/homeg', 'Dashboard\AdminController@index')->name('homeg');
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
    Route::get('addModule', 'ModuleController@addModule')->name('modules.add');
    Route::post('storeModule', 'ModuleController@store')->name('modules.storeModule');
    Route::get('edit/{id}', 'ModuleController@edit')->name('modules.edit');
    Route::post('update/{id}', 'ModuleController@update')->name('modules.update');
    Route::delete('delete/{id}', 'ModuleController@destroy')->name('modules.destroy');



});

Route::group(['namespace'=>'Dashboard','prefix' => 'inscri/'],function(){
    Route::get('/', 'ParentController@index')->name('inscri.index');
    Route::get('/list_accepted', 'ParentController@listAccepted')->name('inscri.list_accepted');

    Route::get('edit/{id}', 'ParentController@edit')->name('isncri.edit');
    Route::post('update/{id}', 'ParentController@update')->name('inscri.update');
    Route::post('updateEleve/{id}', 'ParentController@updateEleve')->name('inscri.updateEleve');
    Route::get('changeStatus/{id}', 'ParentController@changeStatus')->name('inscri.chagestatus');



});
Route::group(['namespace'=>'Dashboard','prefix' => 'student/'],function(){
    Route::get('/', 'StudentController@index')->name('student.index');




});



//Route::get('/home', 'HomeController@index')->name('home');

