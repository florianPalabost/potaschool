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

// Route côté front
Route::get('/',['as'=>'index','uses'=>'Front\FrontController@index']);
Route::get('/wiki',['as'=>'wiki','uses'=>'Front\FrontController@wiki']);


Auth::routes();

// Route en mode Connecté 
Route::get('/profil','Users\ElevesController@getProfil')->name('monprofil');

Route::resource('eleves','Users\ElevesController');

//route enseignant
Route::get('/dashboard','Users\EnseignantsController@showDashboard')->name('dashboard');
Route::resource('classes','ClassesController');
Route::get('medicaments/rech','Users\ElevesController@rechEleve')->name('rechEleve');

// Route pour le test de depart 
Route::get('/testDepart','Users\ElevesController@showTestDepart')->name('testDepart');
Route::post('/testDepart','Users\ElevesController@storeTestDepart')->name('storeTestDepart');

Route::get('/home', 'HomeController@index')->name('home');
