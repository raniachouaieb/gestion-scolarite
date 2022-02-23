<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});



//Route::get('/level', function () {
  //  return view('classroom/create');
//});






Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace'=>'Auth'],function(){
  Route::get('getRegister','RegisterController@getRegister')->name('getRegister');

  Route::post('register', 'RegisterController@register')->name('register');

  });

Route::get('admin', 'Dashboard\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Dashboard\LoginController@login')->name('admin.getLogin');

Route::get('admin/home', 'Dashboard\AdminController@index');