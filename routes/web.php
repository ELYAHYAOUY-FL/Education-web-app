<?php
use App\Http\Controllers\DashboardController;
 
use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\CantineController;
use App\Http\Controllers\TextbookController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesseurController;



// admin prof 

// Define the route for professor creation
Route::post('/admin/professeur', [ProfesseurController::class, 'store']);

Route::get('/professuers', [ProfessuerController::class, 'index']);


Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);

//*************************************************** */

// admin niveau scolaire 
Route::post('adminn/nivScolaircreate',[NiveauScolaireController::class,'store']);
Route::get('adminn/nivScolairListe',[NiveauScolaireController::class,'index']);
// Route::get('admin/nivScolairDelete', [NiveauScolaireController::class, 'destroy']);
Route::delete('admin/deleteNiveauScolair/{id}', [NiveauScolaireController::class, 'destroy']);

// Route::get('adminn/nivScolairupdate',[NiveauScolaireController::class,'update']);
Route::put('/adminn/nivScolairupdate/{id}', [NiveauScolaireController::class, 'update']);
//admin etudaint
 
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


// authentification route 

// Route::group(['middleware' => 'role:administration'], function () {
//     Route::get('/administration', 'AdministrationController@index');
// });

// Route::group(['middleware' => 'role:student'], function () {
//     Route::get('/student', 'StudentController@index');
// });
// Route::group(['middleware' => 'role:student'], function () {
//     Route::get('/student', 'StudentController@index');
// });
// Route::group(['middleware' => 'role:parents'], function () {
//     Route::get('/student', 'StudentController@index');
// });

// Add similar route groups for other roles (professor, parent) as needed




Route::get('/{any}', function () {
    return inertia('welcome');
})->where('any','.*');


 