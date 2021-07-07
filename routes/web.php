<?php

// use App\Http\Middleware\CheckLogin;

// register view
Route::get('/profile', 'Home@profile')->middleware('check.login');
// register view
Route::get('/register', 'Home@register_v');
// login view
Route::get('/', 'Home@login_v');
// update mahasiswa
Route::get('/mahasiswa/update/{id}', 'Home@updateMhs')->middleware('check.login');
Route::post('/mahasiswa/update/data', 'Home@updateData')->middleware('check.login');
// create mahasiswa
Route::get('/mahasiswa/create', 'Home@createMhs')->middleware('check.login');
Route::post('/mahasiswa/create/data', 'Home@createData')->middleware('check.login');
// delete mahasiswa
Route::post('/mahasiswa/delete/data', 'Home@deleteData')->middleware('check.login');
// data mahasiswa
Route::get('/mahasiswa', 'Home@mahasiswa')->middleware('check.login');
// uploed img user
Route::post('/user/upload/img', 'Home@update_img')->middleware('check.login');
Route::post('/user/update/data', 'Home@update_user_data')->middleware('check.login');
Route::post('/user/change/password', 'Home@change_password')->middleware('check.login');
// home
Route::get('/dashboard', 'Home@index')->middleware('check.login');
// export pdf
Route::get('/mahasiswa/export_pdf', 'Home@export_pdf')->middleware('check.login');
// login
Route::post('/login/action', 'Home@login');
//logout
Route::get('/logout', 'Home@logout')->middleware('check.login');
// user view
Route::get('/user', 'Home@user_view')->middleware('check.login');
Route::get('/user/create', 'Home@user_create_view')->middleware('check.login');
Route::get('/user/update/{id}', 'Home@user_fetch_view')->middleware('check.login');
Route::post('/user/create/master/data', 'Home@create_user_master_data')->middleware('check.login');
Route::post('/user/update/master/data', 'Home@update_master_user_data')->middleware('check.login');
Route::post('/user/delete/master/data', 'Home@delete_user_master_data')->middleware('check.login');





