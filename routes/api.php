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
use App\Http\Controllers\ProfessuerController ;

Route::get('/professuers', [ProfessuerController ::class, 'index']);
Route::delete('/admin/profdelete/{id}', [ProfessuerController::class, 'destroy']);
Route::post('/admin/professeur', [ProfessuerController ::class, 'store']);
Route::delete('adminn/nivScolairdelete/{id}', [NiveauScolaireController::class, 'destroy']);
Route::put('/adminn/nivScolairupdate/{id}', 'NiveauScolaireController@update');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

