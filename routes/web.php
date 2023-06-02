<?php
use App\Http\Controllers\DashboardController;
 
use App\Http\Controllers\NiveauScolaireController;

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


 