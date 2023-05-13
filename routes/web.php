<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NiveauScolaireController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
//Route::get('admin/etudiantListe',[EtudiantController::class,'index']);
Route::post('adminn/nivScolaircreate',[NiveauScolaireController::class,'store']);
Route::get('adminn/nivScolairListe',[NiveauScolaireController::class,'index']);
Route::get('/etudiants', [EtudiantController::class, 'index']);
Route::post('admin/etudiantcreate', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);


// Route::get('admin/nivScolairDelete', [NiveauScolaireController::class, 'destroy']);
// Route::delete('/admin/nivScolair/{id}', [NiveauScolaireController::class, 'destroy']);

// Route::get('adminn/nivScolairupdate',[NiveauScolaireController::class,'update']);
Route::put('/adminn/nivScolairupdate/{id}', [NiveauScolaireController::class, 'update']);


Route::get('/{any}', function () {
    return inertia('welcome');
})->where('any','.*');

//  Route::get ('/' , function(){
//      return inertia('Administration');
//  });
//  Route::get ('/hom' , function(){
//     return inertia('Hom');
// });

// Route::get('/etudiant',[EtudiantController::class, "index"])->name("etudiant.index");
// Route::get('/etudiant/create',[EtudiantController::class, "create"])->name("etudiant.create");

// Route::get('/nivreauscolaire',[NiveauScolaireController::class, "index"])->name("nivreauscolaire.index");
// Route::get('/nivreauscolaire/create',[NiveauScolaireController::class, "create"])->name("nivreauscolaire.create");
