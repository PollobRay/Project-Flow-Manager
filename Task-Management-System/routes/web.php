<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get("/home",[PostController::class,"home"]);  // index is the function of PostController


// User Controlller
Route::get('/home',function(){
    return view('home');
})->name('home');

Route::get('signup',function(){
    return view('signup');
})->name('signup');

Route::post('registerSave',[UserController::class,'register'])->name('registerSave');

Route::get('login',function(){
    return view('login');
})->name('login');

Route::post('loginMatch',[UserController::class,'login'])->name('loginMatch');
Route::get('logout',[UserController::class,'logout'])->name('logout');
Route::get('profile',[UserController::class,'profile'])->name('profile');
Route::post('updateUser',[UserController::class,'updateUser'])->name('updateUser');