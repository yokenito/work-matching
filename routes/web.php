<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ChatController;

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
    Route::get('shoe/{work}',[WorkController::class, 'show'])->name('works.show');
    Route::get('edit',[WorkController::class, 'edit'])->name('works.edit')->middleware('auth');
    Route::patch('update',[WorkController::class, 'update'])->name('works.update')->middleware('auth');
    Route::delete('destroy',[WorkController::class, 'destroy'])->name('works.update')->middleware('auth');

    Route::post('nice/{work_id}',[WorkController::class, 'nicestore'])->middleware('auth');
    Route::post('deletenice/{work_id}',[WorkController::class, 'nicedelete'])->middleware('auth');
});

Route::prefix('proposals')->group(function(){
    Route::get('index',[ProposalController::class, 'index'])->name('proposals.index')->middleware('auth');
    Route::get('applicationindex',[ProposalController::class, 'applicationindex'])->name('proposals.applicationindex')->middleware('auth');
    Route::get('receptionindex',[ProposalController::class, 'receptionindex'])->name('proposals.receptionindex')->middleware('auth');
    Route::get('create/{work}',[ProposalController::class, 'create'])->name('proposals.create')->middleware('auth');
    Route::post('store/{work}',[ProposalController::class, 'store'])->name('proposals.store')->middleware('auth');
    Route::get('receptionshow/{work}',[Proposalcontroller::class, 'receptionshow'])->name('proposals.receptionshow')->middleware('auth');
    Route::post('transactionconfirm/{proposal}',[Proposalcontroller::class, 'transactionconfirm'])->name('proposals.transactionconfirm')->middleware('auth');
});

Route::prefix('chats')->group(function(){
    Route::get('index/{proposal}',[ChatController::class,'index'])->name('chats.index')->middleware('auth');
});
