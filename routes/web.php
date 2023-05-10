<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NiveauScolaireController;
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
Route::post('adminn/nivScolaircreate',[NiveauScolaireController::class,'store']);
Route::get('adminn/nivScolairListe',[NiveauScolaireController::class,'index']);

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
