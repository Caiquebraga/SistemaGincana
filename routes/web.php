<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ParticipanteController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('GIN')->group(function(){
    Route::get('/EQU', [EquipeController::class, 'index']);
    Route::get('/PAR', [ParticipanteController::class, 'PartEquipes'])->name('partshowEqu');
    Route::post('/NEWPAR', [ParticipanteController::class, 'create'])->name('adcNewPar');
    Route::get('/EditParShow', [ParticipanteController::class, 'editshow'])->name('edtPar');
    Route::put('/EditarSave', [ParticipanteController::class, 'update'])->name('saveEdit');
    Route::delete('/DeletePar', [ParticipanteController::class, 'delete'])->name('deletePar');
});
