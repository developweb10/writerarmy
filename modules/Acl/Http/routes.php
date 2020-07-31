<?php

Route::group(['middleware' => 'web', 'prefix' => 'acl', 'namespace' => 'Modules\Acl\Http\Controllers'], function()
{
  Route::get('/', 'AclController@index');
  Route::get('/user/{id}/roles/assign', 'AclController@assignRoles')->name('acl.user.roles');
  Route::post('/user/{id}/roles/assign', 'AclController@store')->name('acl.user.roles.store');
  Route::resource('roles', 'RolesController');
  Route::resource('permissions', 'PermissionsController');


  Route::get('/user/create', 'AclController@createUser')->name('acl.user.create');
  Route::post('/user/store', 'AclController@storeUser')->name('acl.user.store');
  Route::get('/user/list', 'AclController@usersList')->name('acl.user.list');
  Route::get('/user/edit/{id}',['as'=>'acl.user.editUser','uses'=>'AclController@editUser']);
  Route::post('/user/edit/{id}',['as'=>'acl.user.updateUser','uses'=>'AclController@updateUser']);
  Route::delete('/user/delete/{id}',['as'=>'acl.user.deleteUser','uses'=>'AclController@deleteUser']);

});
