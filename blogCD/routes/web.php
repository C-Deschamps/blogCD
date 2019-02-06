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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/extra', function () {
    return view('show.extra');
});

Route::get('/overlay', function () {
    return view('animsition.overlay');
});

Route::get('/index', function () {
    return view('animsition.index');
});

Route::get('/animation', function () {
    return view('show.animation');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/video', 'YtbController@displayYt');
Route::get('/carousel', 'YtbController@carousel');
