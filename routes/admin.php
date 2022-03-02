<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['namespace'=>'Dashboard'],function(){
Route::get('/', 'LoginController@showLoginForm')->name('admin.login');
Route::post('dash', 'LoginController@getLogin')->name('admin.getLogin');

});



Route::group(['namespace'=>'Dashboard','prefix' => 'levels/'],function(){
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

Route::group(['namespace'=>'Dashboard','prefix' => 'inscri/'],function(){
    Route::get('/', 'ParentController@index')->name('inscri.index');
    Route::get('edit/{id}', 'ParentController@edit')->name('isncri.edit');
    Route::post('update/{id}', 'ParentController@update')->name('inscri.update');
    Route::post('updateEleve/{id}', 'ParentController@updateEleve')->name('inscri.updateEleve');
    Route::get('changeStatus/{id}', 'ParentController@changeStatus')->name('inscri.chagestatus');

    
   
});
Route::group(['namespace'=>'Dashboard','prefix' => 'student/'],function(){
    Route::get('/', 'StudentController@index')->name('student.index');
    

    
   
});



//Route::get('/home', 'HomeController@index')->name('home');

