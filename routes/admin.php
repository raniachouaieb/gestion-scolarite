<?php

use Illuminate\Support\Facades\Route;
define('PAGINATION', 3);

Route::group(['namespace'=>'Dashboard'],function(){
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('getLogin', 'LoginController@getLogin')->name('admin.getLogin');
});



Route::get('accueil', 'Dashboard\AdminController@index')->name('accueil');

Route::post('logout', 'Dashboard\AdminController@logout')->name('logouteff');


Route::group(['namespace'=>'Dashboard', 'prefix'=>'users'], function(){
    Route::get('admins','AdminController@list')->name('admins');
    Route::get('add', 'AdminController@add')->name('users.add');
    Route::post('storeUser', 'AdminController@storeUser')->name('users.storeUser');
    Route::get('edit\{id}', 'AdminController@edit')->name('users.edit');
    Route::post('update\{id}', 'AdminController@update')->name('users.update');
    Route::post('delete/{id}', 'AdminController@destroy')->name('users.destroy');
    Route::get('profile\{id}', 'AdminController@profile')->name('profile');
    Route::post('Updateprofile\{id}', 'AdminController@updateImg')->name('Updateprofile');
    Route::post('changeStatus/{id}', 'AdminController@changeStatus')->name('changeStatus');


});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'enseignants'], function(){
    Route::get('enseignants','EnseignantController@index')->name('enseignants');
    Route::get('add','EnseignantController@add')->name('enseignant.add');
    Route::post('create', 'EnseignantController@create')->name('enseignant.create');
    Route::post('changeStatus/{id}', 'EnseignantController@changeStatus')->name('changeStatus');
    Route::get('edit/{id}', 'EnseignantController@edit')->name('enseignant.edit');
    Route::post('update\{id}', 'EnseignantController@update')->name('enseignant.update');

    Route::post('delete/{id}', 'EnseignantController@destroy')->name('enseignant.destroy');
    Route::get('getModule', 'EnseignantController@getModule')->name('enseignant.getModule');





});
Route::group(['namespace'=>'Dashboard', 'prefix'=>'roles'], function(){
    Route::get('list','RoleController@index')->name('list');
    Route::get('add', 'RoleController@add')->name('roles.add');
    Route::post('store', 'RoleController@store')->name('roles.store');
    Route::get('edit\{id}', 'RoleController@edit')->name('roles.edit');
    Route::post('update\{id}', 'RoleController@update')->name('roles.update');
    Route::post('destroy\{id}', 'RoleController@destroy')->name('roles.destroy');



});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'permissions'], function(){
    Route::get('permission', 'PermissionController@index')->name('permissions');
    Route::get('add', 'PermissionController@add')->name('permissions.add');
    Route::post('store','PermissionController@store')->name('permissions.store');
    Route::get('edit\{id}', 'PermissionController@edit')->name('permissions.edit');
    Route::post('update\{id}', 'PermissionController@update')->name('permissions.update');
    Route::post('delete/{id}', 'PermissionController@destroy')->name('permissions.destroy');

});
Route::group(['namespace'=>'Dashboard', 'prefix'=>'matrix'], function(){
    Route::get('all', 'MatrixController@index')->name('all');
});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'absences'], function(){
    Route::get('/', 'AbsenceController@index')->name('absence.index');
    Route::get('getClasse', 'AbsenceController@getClasse')->name('absence.getClasse');
    Route::get('eleveByClass', 'AbsenceController@eleveByClass')->name('absence.eleveByClass');
    Route::post('store', 'AbsenceController@store')->name('absence.store');


});






Route::group(['namespace'=>'Dashboard','prefix' => 'levels'],function(){
    Route::get('/', 'LevelController@index')->name('levels.index');
    Route::get('show/{id}', 'LevelController@show');
    Route::get('addLevel', 'LevelController@addLevel')->name('levels.add');
    Route::post('store', 'LevelController@store')->name('levels.store');
    Route::get('edit/{id}', 'LevelController@edit')->name('levels.edit');
    Route::post('update/{id}', 'LevelController@update')->name('levels.update');
    Route::post('delete/{id}', 'LevelController@destroy')->name('levels.destroy');
});

Route::group(['namespace'=>'Dashboard','prefix' => 'classes/'],function(){
    Route::get('/', 'ClassroomController@index')->name('classes.index');
    Route::get('show/{id}', 'ClassroomController@show');
    Route::get('addClass', 'ClassroomController@addClass')->name('classes.add');
    Route::post('store', 'ClassroomController@store')->name('classes.store');
    Route::get('edit/{id}', 'ClassroomController@edit')->name('classes.edit');
    Route::post('update/{id}', 'ClassroomController@update')->name('classes.update');
    Route::post('delete/{id}', 'ClassroomController@destroy')->name('classes.destroy');
    Route::get('classByLevel', 'ClassroomController@classByLevel')->name('classes.classByLevel');

});

Route::group(['namespace'=>'Dashboard','prefix' => 'matieres/'],function(){
    Route::get('/', 'MatiereController@index')->name('matieres.index');
    Route::get('addMatiere', 'MatiereController@addMatiere')->name('matieres.add');
    Route::post('storeMatiere', 'MatiereController@store')->name('matieres.storeMatiere');
    Route::get('edit/{id}', 'MatiereController@edit')->name('matieres.edit');
    Route::post('update/{id}', 'MatiereController@update')->name('matieres.update');
    Route::delete('delete/{id}', 'MatiereController@destroy')->name('matieres.destroy');
    Route::get('getModule', 'MatiereController@getModule')->name('matieres.getModule');

});

Route::group(['namespace'=>'Dashboard','prefix' => 'modules/'],function(){
    Route::get('/', 'ModuleController@index')->name('modules.index');
    Route::get('show/{id}', 'ModuleController@show')->name('modules.show');
    Route::get('addModule', 'ModuleController@addModule')->name('modules.add');
    Route::post('storeModule', 'ModuleController@store')->name('modules.storeModule');
    Route::get('edit/{id}', 'ModuleController@edit')->name('modules.edit');
    Route::post('update/{id}', 'ModuleController@update')->name('modules.update');
    Route::post('delete/{id}', 'ModuleController@destroy')->name('modules.destroy');
    Route::get('moduleByLevel', 'ModuleController@moduleByLevel')->name('modules.moduleByLevel');

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
    Route::post('delete/{id}', 'ConvocationController@destroy')->name('convocations.destroy');
    Route::get('search', 'ConvocationController@search')->name('convocations.search');


});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'info/'], function(){
    Route::get('/', 'InfoController@index')->name('info.index');
    Route::get('add', 'InfoController@add')->name('info.add');
    Route::post('store', 'InfoController@store')->name('info.store');
    Route::get('edit/{id}', 'InfoController@edit')->name('info.edit');
    Route::post('update/{id}', 'InfoController@update')->name('info.update');
    Route::get('getClasse', 'InfoController@getClasse')->name('info.getClasse');
    Route::post('delete/{id}', 'InfoController@destroy')->name('info.destroy');


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
    Route::get('download/{file}', 'TravailController@download')->name('download');
    Route::get('view/{id}', 'TravailController@view')->name('view');




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
    Route::get('add', 'ParentController@add')->name('inscri.add');





});
Route::group(['namespace'=>'Dashboard','prefix' => 'student/'],function(){
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::get('eleveByClass', 'StudentController@eleveByClass')->name('student.eleveByClass');
    Route::get('edit\{id}', 'StudentController@edit')->name('student.edit');
    Route::post('update\{id}', 'StudentController@update')->name('student.update');
    Route::get('getClasse', 'StudentController@getClasse')->name('student.getClasse');
    Route::get('elevePreInscrit','StudentController@elevePreInscrit')->name('student.elevePreInscrit');
    Route::get('search', 'StudentController@search')->name('student.search');


});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'emploi/'], function(){
    Route::get('/', 'EmploiController@index')->name('emploi.index');
    Route::get('add', 'EmploiController@add')->name('emploi.add');
    Route::post('store', 'EmploiController@store')->name('emploi.store');
    Route::get('editEmploi\{id}', 'EmploiController@editEmploi')->name('emploi.editEmploi');
    Route::post('update\{id}', 'EmploiController@update')->name('emploi.update');
    Route::get('getClasse', 'EmploiController@getClasse')->name('emploi.getClasse');
    Route::delete('delete/{id}', 'EmploiController@destroy')->name('emploi.destroy');




});

Route::group(['namespace'=>'Dashboard', 'prefix'=>'seance/'], function(){
    Route::get('/', 'SeanceController@index')->name('seance.index');
    Route::get('add', 'SeanceController@add')->name('seance.add');
    Route::post('store', 'SeanceController@store')->name('seance.store');
    Route::delete('delete/{id}', 'SeanceController@destroy')->name('seance.destroy');
    Route::get('getEmploi', 'SeanceController@getEmploi')->name('seance.getEmploi');
    Route::get('getMatiere', 'SeanceController@getMatiere')->name('seance.getMatiere');
    Route::get('edit/{id}', 'SeanceController@edit')->name('seance.edit');
    Route::post('update/{id}','SeanceController@update')->name('seance.update');


});





//Route::get('/home', 'HomeController@index')->name('home');

