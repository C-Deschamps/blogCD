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

//Crétion d'un nouveau sujet
Route::get('/newSujet', function () {
    return view('forum.newSujet');
});
Route::post('/newSujet', 'SujetsController@post');
Route::get('/forum', 'SujetsController@show');

Route::get('/showOneSujet/{id}', 'CommentsController@show');


//Route::post('/showOneSujet/{id}', 'CommentsController@newCommentPost');


Route::get('/showOneSujet/{idSujet}/{numPage}', 'CommentsController@showMore');

Route::get('/answer/{idComment}', 'CommentsController@answer');

Route::get('/userInfo/{idUser}', 'HomeController@showUserInfo');

Route::post('/nav/{id}', 'CommentsController@navPost');
Route::post('/newComment/{id}', 'CommentsController@newCommentPost');

Route::get('/admin/createQuizz', function () {
    return view('admin.createQuizz');
});

Route::post('/postQuizz', 'QuizController@postQuizz');

Route::get('/quizz', 'QuizController@show');
Route::get('/showQuizz/{id}', 'QuizController@showOne');
