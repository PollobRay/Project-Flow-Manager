<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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
    return view('home');
});

Route::get('/home',function(){
    return view('home');
})->name('home');

// **************************       User Controlller  *******************************
Route::get('signup',[UserController::class,'signupWindow'])->name('signup');
Route::post('registerSave',[UserController::class,'register'])->name('registerSave');
Route::get('login',[UserController::class,'loginWindow'])->name('login');
Route::post('loginMatch',[UserController::class,'login'])->name('loginMatch');
Route::get('logout',[UserController::class,'logout'])->name('logout');
Route::get('profile',[UserController::class,'profile'])->name('profile');
Route::post('updateUser',[UserController::class,'updateUser'])->name('updateUser');

//  **************************     Category Controller ********************************
Route::get('category',[CategoryController::class,'index'])->name('category');
Route::get('addCategory',[CategoryController::class,'create'])->name('addCategory');
Route::post('storeCategory',[CategoryController::class,'store'])->name('storeCategory');

//  ***************************      Project Controller ********************************
Route::get('addProject',[ProjectController::class,'create'])->name('addProject');
Route::post('storeProject',[ProjectController::class,'store'])->name('storeProject');
Route::get('projects/{id}',[ProjectController::class,'index'])->whereNumber('id')->name('projects');
Route::get('allprojects',[ProjectController::class,'indexAll'])->name('allprojects');
Route::get('myprojects',[ProjectController::class,'indexMy'])->name('myprojects');
Route::get('viewProject/{id}',[ProjectController::class,'show'])->whereNumber('id')->name('viewProject');
Route::get('addProjectUser/{id}',[ProjectController::class,'indexParticipant'])->whereNumber('id')->name('addProjectUser');
Route::get('storeProjectParticipant/{proj_id}/{user_id}',[ProjectController::class,'storeParticipant'])->whereNumber('proj_id')->whereNumber('user_id')->name('storeProjectParticipant');
Route::get('updateProject/{id}',[ProjectController::class,'updateWindow'])->whereNumber('id')->name('updateProject');
Route::post('makeUpdateProject/{id}',[ProjectController::class,'makeUpdateProject'])->whereNumber('id')->name('makeUpdateProject');
Route::get('deleteProject/{id}',[ProjectController::class,'deleteProject'])->whereNumber('id')->name('deleteProject');
Route::get('removeParticipant/{proj_id}/{user_id}',[ProjectController::class,'removeParticipant'])->whereNumber('proj_id')->whereNumber('user_id')->name('removeParticipant');

// ****************************   Task Controller *******************************************************
Route::get('addTask/{id}',[TaskController::class,'create'])->whereNumber('id')->name('addTask');
Route::post('storeTask/{id}',[TaskController::class,'store'])->whereNumber('id')->name('storeTask');
Route::get('viewTask/{proj_id}/{id}',[TaskController::class,'show'])->whereNumber('proj_id')->whereNumber('id')->name('viewTask');
Route::get('markAsComplete/{proj_id}/{id}',[TaskController::class,'markAsComplete'])->whereNumber('proj_id')->whereNumber('id')->name('markAsComplete');
Route::get('myTasks',[TaskController::class,'myTasks'])->name('myTasks');
Route::post('addTaskResponse/{proj_id}/{id}',[TaskController::class,'storeTaskResponse'])->whereNumber('proj_id')->whereNumber('id')->name('addTaskResponse');
Route::get('updateTaskWindow/{proj_id}/{id}',[TaskController::class,'updateTaskWindow'])->whereNumber('proj_id')->whereNumber('id')->name('updateTaskWindow');
Route::post('updateTask/{id}',[TaskController::class,'updateTask'])->whereNumber('id')->name('updateTask');
Route::get('deleteTask/{id}',[TaskController::class,'deleteTask'])->whereNumber('id')->name('deleteTask');

