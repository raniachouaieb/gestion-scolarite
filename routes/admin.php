<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace'=>'Dashboard','prefix' => 'levels/'],function(){
    Route::get('/', 'LevelController@index');
    Route::get('show/{id}', 'LevelController@show');
    Route::get('addLevel', 'LevelController@addLevel');
    Route::post('store', 'LevelController@store');
    Route::post('update/{id}', 'LevelController@addLevel');
    Route::delete('delete/{id}', 'LevelController@destroy');



});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('admin', 'Dashboard\LoginController@showLoginForm')->name('admin.login');
//Route::post('admin', 'Dashboard\LoginController@login');

//Route::get('admin/home', 'Dashboard\AdminController@index');
