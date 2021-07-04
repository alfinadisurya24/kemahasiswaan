<?php

// register view
Route::get('/profile', 'Home@profile');
// register view
Route::get('/register', 'Home@register_v');
// login view
Route::get('/', 'Home@login_v');
// update mahasiswa
Route::get('/mahasiswa/update/{id}', 'Home@updateMhs');
Route::post('/mahasiswa/update/data', 'Home@updateData');
// create mahasiswa
Route::get('/mahasiswa/create', 'Home@createMhs');
Route::post('/mahasiswa/create/data', 'Home@createData');
// delete mahasiswa
Route::post('/mahasiswa/delete/data', 'Home@deleteData');
// data mahasiswa
Route::get('/mahasiswa', 'Home@mahasiswa');
// uploed img user
Route::post('/user/upload/img', 'Home@update_img');
Route::post('/user/update/data', 'Home@update_user_data');
Route::post('/user/change/password', 'Home@change_password');
// home
Route::get('/dashboard', 'Home@index');
// export pdf
Route::get('/mahasiswa/export_pdf', 'Home@export_pdf');
// login
Route::post('/login/action', 'Home@login');
//logout
Route::get('/logout', 'Home@logout');
// user view
Route::get('/user', 'Home@user_view');
Route::get('/user/create', 'Home@user_create_view');
Route::get('/user/update/{id}', 'Home@user_fetch_view');
Route::post('/user/create/master/data', 'Home@create_user_master_data');
Route::post('/user/update/master/data', 'Home@update_master_user_data');
Route::post('/user/delete/master/data', 'Home@delete_user_master_data');





