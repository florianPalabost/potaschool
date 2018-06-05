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

Route::group(['prefix' => 'cours'],function(){

    Route::get('/matiere','Cours\MatiereController@getList')->name('matiereList');
    Route::get('/matiere/add','Cours\MatiereController@add')->name('newMatiere');
    Route::post('/matiere/add','Cours\MatiereController@save')->name('saveMatiere');
    Route::get('/matiere/{id}','Cours\MatiereController@get')->where('id','[0-9]+')->name('seeMatiere');

    Route::resource('module','Cours\ModuleController');
    Route::resource('cours','Cours\CoursController');

});

// Route pour le test de depart
Route::get('/testDepart','Users\ElevesController@showTestDepart')->name('testDepart');
Route::post('/testDepart','Users\ElevesController@storeTestDepart')->name('storeTestDepart');

// Routes pour le potager
Route::get('/potager', 'PotagersController@index')->name('indexPotager');
Route::get('/potager/findModule', 'PotagersController@findModule')->name('findModule');
Route::get('/potager/findCours', 'PotagersController@findCours')->name('findCours');
Route::POST('/potager/addGraine', 'PotagersController@storeGraine')->name('storeGraine');



Route::get('/home', 'HomeController@index')->name('home');
