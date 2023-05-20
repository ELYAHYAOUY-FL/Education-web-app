<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NiveauScolaireController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesseurController;



// admin prof 

// Define the route for professor creation
Route::post('/admin/professeur', [ProfesseurController::class, 'store']);

Route::get('/professuers', [ProfessuerController::class, 'index']);



//*************************************************** */

// admin niveau scolaire 
Route::post('adminn/nivScolaircreate',[NiveauScolaireController::class,'store']);
Route::get('adminn/nivScolairListe',[NiveauScolaireController::class,'index']);
// Route::get('admin/nivScolairDelete', [NiveauScolaireController::class, 'destroy']);
Route::delete('admin/deleteNiveauScolair/{id}', [NiveauScolaireController::class, 'destroy']);

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
