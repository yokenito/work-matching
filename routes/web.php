<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;

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


Route::get('/', [WorkController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('works')->group(function(){
    Route::get('index',[WorkController::class, 'index'])->name('works.index');
    Route::get('create',[WorkController::class, 'create'])->name('works.create')->middleware('auth');
    Route::post('store',[WorkController::class, 'store'])->name('works.store')->middleware('auth');
    Route::get('edit',[WorkController::class, 'edit'])->name('works.edit')->middleware('auth');
    Route::patch('update',[WorkController::class, 'update'])->name('works.update')->middleware('auth');
    Route::delete('destroy',[WorkController::class, 'destroy'])->name('works.update')->middleware('auth');

    Route::post('nice/{work_id}',[WorkController::class, 'nicestore'])->middleware('auth');
    Route::post('deletenice/{work_id}',[WorkController::class, 'nicedelete'])->middleware('auth');
});
