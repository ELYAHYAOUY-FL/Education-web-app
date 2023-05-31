<?php

use App\Http\Controllers\EmploiTempController;
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
	
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\ProfesseurController ;
use App\Http\Controllers\MatiereController ;
// use App\Http\Controllers\GroupeController ;
use App\Http\Controllers\ClasseMatiereController ;
use App\Http\Controllers\Bankinformation_ProfController ;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParentEleveController;




// niveua scolaire api 
Route::get('/niveau_scolires', [NiveauScolaireController ::class, 'index']);
Route::post('/niveau_scolires', [NiveauScolaireController ::class, 'store']);
Route::delete('/niveau_scolires/{id}', [NiveauScolaireController ::class, 'destroy']);
Route::put('/niveau_scolires/{id}', [NiveauScolaireController ::class,'update']);

// professuers 
Route::get('/professeurs', [ProfesseurController  ::class, 'index']);
Route::post('/professeurs', [ProfesseurController::class, 'store']);
Route::delete('/professeurs/{id}', [ProfesseurController::class, 'destroy']);
Route::put('/professeurs/{id}', [ProfesseurController::class, 'update']);
Route::get('/professeurs/user/{userId}', [ProfesseurController::class, 'getById']);


//Eleve
Route::post('/eleves', [EleveController::class, 'store']);
Route::get('/eleves', [EleveController::class, 'index']);
Route::delete('/eleves/{id}', [EleveController::class, 'destroy']);
Route::put('/eleves/{id}', [EleveController::class, 'update']);
Route::get('/eleves/user/{userId}', [EleveController::class, 'getById']);


//parent 
Route::get('/parents', [ParentController::class, 'index']);
Route::post('/parents', [ParentController::class, 'store']);
Route::get('/parents/create', [ParentController::class, 'create']);
// Route::post('/parents', [ParentController::class, 'create']);
Route::post('/parents/{parentId}/eleves', [ParentController::class, 'associateEleve']);

// 
// routes/api.php



Route::get('/parents/eleves', [ParentEleveController::class, 'index']);
Route::post('/parents/eleves', [ParentEleveController::class, 'store']);


// matiers 
Route::get('/matieres', [MatiereController::class, 'index']);
Route::post('/matieres', [MatiereController::class, 'store']);



Route::get('/professeurs/{id}', [ProfesseurController::class, 'getById']);

// classes
Route::get('/groupes', [GroupeController::class, 'index']);


//payement
Route::post('/payements', [PayementsdemoiController::class, 'store']);
Route::get('/payements', [PayementsdemoiController::class, 'index']);

 

//classes and matiers relation 
Route::get('/classe_matiere', [ClasseMatiereController ::class, 'index']);

// vireemnet 
Route::get('/bankinformations', [Bankinformation_ProfController ::class, 'index']);
Route::post('/bankinformations', [Bankinformation_ProfController ::class, 'store']);

Route::post('/virements', [VirementController ::class, 'store']);
// use App\Http\Controllers\ProfessuerController ;

use App\Http\Controllers\ActivityController;


Route::post('/activities', [ActivityController::class, 'store']);

Route::delete('/activities/{id}', [ActivityController::class, 'destroy']);



use App\Http\Controllers\TextbookController;
//textbook prof
// Route::post('/textbooks', [TextbookController::class, 'store']);
Route::put('/textbooks/{id}', [TextbookController::class, 'update']);
Route::delete('/textbooks/{id}', [TextbookController::class, 'destroy']);
Route::get('/textbooks', [TextbookController::class, 'index']);
Route::get('/textbooks/{id}', [TextbookController::class, 'show']);
Route::post('/textbooks', [TextbookController::class, 'store']) ;
Route::get('/textbooks/getbyProf/{ProfId}', [TextbookController::class, 'gettextbookbyidprof']) ;

//users
// Route::post('/users', [UserController::class, 'store']) ;
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);



//Calendrie
use App\Http\Controllers\EventController;
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);

//emploi temps
Route::post('/emplois', [EmploiTempController::class, 'store']);
// Route::get('/professeurs/user/{userId}', [ProfesseurController::class, 'getProfById']);
Route::get('/emplois/Professeur/{MatiereId}', [EmploiTempController::class, 'getEmploiProf']);

Route::get('/emplois', [ EmploiTempController::class, 'getSchedulesByGroup']);
// Route::get('/emplois', [EmploiTempController::class, 'getEmplois']);
Route::get('/emplois/groupe/{EmploiId}', [EmploiTempController::class, 'getEmplois']);



// groupes
Route::get('/groupes/{groupeId}', [GroupeController::class, 'show']);
Route::get('/groupes', [GroupeController::class, 'index']);
Route::post('/groupes', [GroupeController::class, 'store']);
// Route::get('/matieres', [MatiereController::class, 'index']);



use App\Http\Controllers\CantineController;
//cantine 
Route::get('/programme-semaine', [CantineController::class, 'getProgrammeSemaine']);
Route::put('/menu-jour/{nom}', [CantineController::class, 'updateMenuJour']);
Route::delete('/menu-jour/{id}', [CantineController::class, 'supprimerJour']);
Route::get('/menu-jour/{nom}', [CantineController::class, 'getMenuJour']);
Route::post('/ajouter-menu', [CantineController::class, 'ajouterMenu']);

//activity
Route::get('/activities', [ActivityController::class, 'index']);
Route::post('/activities', [ActivityController::class, 'store']);
Route::get('/activities/{id}', [ActivityController::class, 'show']);
Route::put('/activities/{id}', [ActivityController::class, 'update']);

// notess 
Route::post('/activities', [ActivityController::class, 'store']);





Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'v1'], function () {
    //Auth routes
    Route::group(['prefix' => 'auth', 'name' => 'auth.'], function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth:sanctum');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/user', [AuthController::class, 'user'])->name('user');
    });
 });

