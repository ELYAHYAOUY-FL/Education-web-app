<?php

use App\Http\Controllers\PayementsdemoiController;
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
use App\Http\Controllers\VirementController ;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ParentController;


// niveua scolaire api 
Route::get('/niveau_scolires', [NiveauScolaireController ::class, 'index']);
Route::post('/niveau_scolires', [NiveauScolaireController ::class, 'store']);
Route::delete('/niveau_scolires/{id}', [NiveauScolaireController ::class, 'destroy']);
Route::put('/niveau_scolires/{id}', [NiveauScolaireController ::class,'update']);

// professuers 
Route::get('/professuers', [ProfesseurController  ::class, 'index']);
Route::post('/professuers', [ProfesseurController ::class, 'store']);
Route::delete('/professuers/{id}', [ProfesseurController::class, 'destroy']);
Route::put('professuers/{id}', [ProfesseurController::class, 'update']);


//Eleve
Route::post('/eleves', [EleveController::class, 'store']);
Route::get('/eleves', [EleveController::class, 'index']);
Route::delete('/eleves/{id}', [EleveController::class, 'destroy']);
Route::put('/eleves/{id}', [EleveController::class, 'update']);

//parent 
Route::get('/parents', [ParentController::class, 'index']);
Route::post('/parents', [ParentController::class, 'store']);
Route::get('/parents/create', [ParentController::class, 'create']);




// matiers 
Route::get('/matieres', [MatiereController::class, 'index']);


// classes
Route::get('/classes', [ClassController::class, 'index']);

//payement
Route::post('/payements', [PayementsdemoiController::class, 'store']);
Route::get('/payements', [PayementsdemoiController::class, 'index']);

 

//classes and matiers relation 
Route::get('/classe_matiere', [ClasseMatiereController ::class, 'index']);

// vireemnet 
Route::get('/virements', [VirementController ::class, 'index']);

Route::post('/virements', [VirementController ::class, 'store']);
// use App\Http\Controllers\ProfessuerController ;

use App\Http\Controllers\ActivityController;


Route::post('/activities', [ActivityController::class, 'store']);

Route::delete('/activities/{id}', [ActivityController::class, 'destroy']);



use App\Http\Controllers\TextbookController;
// Route::post('/textbooks', [TextbookController::class, 'store']);
Route::put('/textbooks/{id}', [TextbookController::class, 'update']);
Route::delete('/textbooks/{id}', [TextbookController::class, 'destroy']);
Route::get('/textbooks', [TextbookController::class, 'index']);
Route::get('/textbooks/{id}', [TextbookController::class, 'show']);
Route::post('/textbooks', [TextbookController::class, 'store']) ;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

