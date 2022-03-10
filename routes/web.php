<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});




Auth::routes(['verify' => true]);

Route::group(['namespace'=>'Front'],function(){
    Route::get('parentHome', 'HomeParentController@index')->name('parentHome');
});


Route::group(['namespace'=>'Auth'],function(){
    Route::get('getLogin','LoginController@getLogin')->name('getLogin');
    Route::post('login','LoginController@login')->name('login');
    Route::get('getRegister','RegisterController@getRegister')->name('getRegister');

  });

/*Route::post('/password/email', 'Front\ForgotPasswordController@sendResetLinkEmail')->name('parent.password.email');
Route::post('/password/reset', 'Front\ResetPasswordController@reset');
Route::get('/password/reset', 'Front\ForgotPasswordController@showLinkRequestForm')->name('parent.password.request');
Route::get('/password/reset/{token}', 'Front\ResetPasswordController@showResetForm')->name('parent.password.reset');*/







