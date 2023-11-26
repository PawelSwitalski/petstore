<?php

use App\Http\Controllers\PetController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::controller(PetController::class)
    ->group(function () {
    Route::post('/pets/{id}/uploadImage', [PetController::class, 'uploadImage'])->name('pets.uploadImage');
    Route::post('/pets', [PetController::class, 'create'])->name('pets.create');


    Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');

    Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');


    Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::get('/pets/findByStatus/{status}', [PetController::class, 'findByStatus'])
        ->whereIn('status', ['available', 'pending', 'sold'])
        ->name('pets.findByStatus');
});
