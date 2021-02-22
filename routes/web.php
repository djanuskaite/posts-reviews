<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SpecializationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [MainController::class, 'index']);
Route::get('/add-post', [MainController::class, 'addPost']);
Route::get('/add-company', [CompanyController::class, 'addCompany'] );
Route::get('/add-specialization', [SpecializationController::class, 'addSpecialization'] );
Route::post('/comp', [CompanyController::class, 'toAddCompany']);
Route::post('/spec', [SpecializationController::class, 'toAddSpecialization']);
//Route::get('/add-post', 'MainController@addPost');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-companies', [CompanyController::class, 'showComp']);
Route::get('/delete/company/{company}', [CompanyController::class, 'deleteComp']);
Route::get('/all-specializations', [SpecializationController::class, 'showSpec']);
Route::get('/delete/specialization/{specialization}', [SpecializationController::class, 'deleteSpec']);
Route::get('/post/{post}', [MainController::class, 'showFull']);
Route::post('/store', [MainController::class, 'store']);
Route::post('/review', [ReviewController::class, 'addingReview']);

Route::get('/delete/post/{post}', [MainController::class, 'delete']);
Route::get('/edit/post/{post}', [MainController::class, 'editPost']);
Route::patch('/storeupdate/{post}', [MainController::class, 'storeUpdate']);
Route::get('/search', [SearchController::class, 'index']);


Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
