<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
	
use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\ProfesseurController ;
use App\Http\Controllers\MatiereController ;
use App\Http\Controllers\ClassController ;
use App\Http\Controllers\ClasseMatiereController ;
// niveua scolaire api 
Route::get('/niveau_scolires', [NiveauScolaireController ::class, 'index']);
Route::post('/niveau_scolires', [NiveauScolaireController ::class, 'store']);
Route::delete('/niveau_scolires/{id}', [NiveauScolaireController ::class, 'destroy']);
Route::put('/niveau_scolires/{id}', [NiveauScolaireController ::class,'update']);

// professuers 
Route::get('/professuers', [ProfesseurController ::class, 'index']);
Route::post('/professuers', [ProfesseurController ::class, 'store']);
Route::delete('/professuers/{id}', [ProfesseurController::class, 'destroy']);
Route::put('professuers/{id}', [ProfesseurController::class, 'update']);

Route::get('/matieres', [MatiereController  ::class, 'index']);

Route::get('/classes', [ClassController ::class, 'index']);

Route::get('/classe_matiere', [ClasseMatiereController ::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

