<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkorderStateController;
use App\Http\Controllers\PieceController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    //only authenticated users can access these routes    
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit']);
    Route::get('/clients/{id}/delete', [ClientController::class, 'delete']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

    Route::get('/workorderstates', [WorkorderStateController::class, 'index'])->name('workorderstates');
    Route::get('/workorderstates/create', [WorkorderStateController::class, 'create']);
    Route::get('/workorderstates/{id}/edit', [WorkorderStateController::class, 'edit']);
    Route::get('/workorderstates/{id}/delete', [WorkorderStateController::class, 'delete']);
    Route::post('/workorderstates', [WorkorderStateController::class, 'store']);
    Route::put('/workorderstates/{id}', [WorkorderStateController::class, 'update']);
    Route::delete('/workorderstates/{id}', [WorkorderStateController::class, 'destroy']);

    Route::get('/pieces', [PieceController::class, 'index'])->name('pieces');
    Route::get('/pieces/create', [PieceController::class, 'create']);
    Route::get('/pieces/{id}/edit', [PieceController::class, 'edit']);
    Route::get('/pieces/{id}/delete', [PieceController::class, 'delete']);
    Route::post('/pieces', [PieceController::class, 'store']);
    Route::put('/pieces/{id}', [PieceController::class, 'update']);
    Route::delete('/pieces/{id}', [PieceController::class, 'destroy']);


    Route::resource('/img', App\Http\Controllers\ImageController::class);
});