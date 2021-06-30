<?php

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

// register view
Route::get('/profile', 'Home@profile');

// register view
Route::get('/register', 'Home@register_v');

// login view
Route::get('/login', 'Home@login_v');

// update mahasiswa
Route::get('/mahasiswa/update/{id}', 'Home@updateMhs');

// create mahasiswa
Route::get('/mahasiswa/create', 'Home@createMhs');

// data mahasiswa
Route::get('/mahasiswa', 'Home@mahasiswa');

// home
Route::get('/', 'Home@index');
