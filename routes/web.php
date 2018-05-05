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
Route::get('/home', 'HomeController@index')->name('home');
