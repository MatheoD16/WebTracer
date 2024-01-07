<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'accueil'])->name("accueil");

Route::get('/scenes/index', [SceneController::class, 'index'])->name("scenes.index");
Route::get('/home',[HomeController::class,'home'] )->name("home.home");

Route::get('/contact', [HomeController::class,'contact'])->name("home.contact");

Route::get('/apropos', [HomeController::class,'aPropos'])->name("home.apropos");

Route::post('/contact',[HomeController::class,'contactShow'])->name("home.contactShow");

Route::get('/profil/{id}', [UserController::class, 'profil'])->name('user.profil');

Route::post('/updateAvatar/{id}',[UserController::class,'changeAvatar'])->name("user.avatarUpdate");
Route::get('/scenes/{id}', [SceneController::class, 'show'])->name("scenes.show");


Route::post('/scenes/{id}/addFavoris/{user_id}', [SceneController::class, 'addFavoris'])->name("scenes.addFavoris");

Route::post('/scenes/{id}/deleteFavoris/{user_id}', [SceneController::class, 'deleteFavoris'])->name("scenes.deleteFavoris");

Route::post('/scenes/{id}/addNote/{user_id}', [NoteController::class, 'addNote'])->name("scenes.addNote");

Route::post('/scenes/{id}/updateNote/{user_id}', [NoteController::class, 'updateNote'])->name("scenes.updateNote");

Route::post('/scenes/{id}/deleteNote/{user_id}', [NoteController::class, 'deleteNote'])->name("scenes.deleteNote");

Route::get('/scenes/com/{id}', [SceneController::class, 'createCom'])->name("scenes.createCom");
Route::get('/scenes/delCom/{id}/{scene_id}', [SceneController::class, 'deleteCom'])->name("scenes.deleteCom");
Route::get('/scenes/editCom/{id}/{scene_id}', [SceneController::class, 'editCom'])->name("scenes.editCom");

Route::post("/scenes/{id}",[SceneController::class,"storeCom"])->name("scenes.storeCom");
Route::post("/scenes/editCom/{id}/{scene_id}",[SceneController::class,"updateCom"])->name("scenes.updateCom");
