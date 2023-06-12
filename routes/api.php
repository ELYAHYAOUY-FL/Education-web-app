<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevoirController;
use App\Http\Controllers\EmploiTempController;
use App\Http\Controllers\PayementsdemoiController;
use App\Http\Controllers\SalaireController;
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

use App\Http\Controllers\Bankinformation_ParentController;
use App\Http\Controllers\CarnetNoteController;	
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
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TextbookController;
use App\Http\Controllers\CantineController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\EleveExamController;
use App\Http\Controllers\CoursDevoirsController;





// niveua scolaire api 
Route::get('/niveau_scolires', [NiveauScolaireController ::class, 'index']);
Route::post('/niveau_scolires', [NiveauScolaireController ::class, 'store']);
Route::delete('/niveau_scolires/{id}', [NiveauScolaireController ::class, 'destroy']);
Route::put('/niveau_scolires/{id}', [NiveauScolaireController ::class,'update']);

// professuers 
Route::get('/professeurs', [ProfesseurController  ::class, 'index']);
Route::post('/professeurs', [ProfesseurController::class, 'store']);
Route::delete('/professuers/{id}', [ProfesseurController::class, 'destroy']);

Route::put('/professeurs/{id}', [ProfesseurController::class, 'update']);
Route::get('/professeurs/user/{userId}', [ProfesseurController::class, 'getById']);
Route::get('/professuer/user/carnetnotes/{userId}', [ProfesseurController::class, 'getByIdlastcarnetBYgroupe']);
Route::get('/eleves/user/carnetnotes/{userId}', [EleveController::class, 'getLastCarentByProf']);


//Eleve
Route::post('/eleves', [EleveController::class, 'store']);
Route::get('/eleves', [EleveController::class, 'index']);
Route::get('/eleves/devoir/{eleveid}', [EleveController::class, 'getDevoir']);
Route::delete('/eleves/{id}', [EleveController::class, 'destroy']);
Route::get('/eleves/{id}', [EleveController::class, 'show']);
Route::get('/eleves/carnet/{id}/{groupeId}', [EleveController::class, 'getLastCarnetDeNoteByEleveAndGroupe']);
Route::put('/eleves/{id}', [EleveController::class, 'update']);
Route::get('/eleves/user/{userId}', [EleveController::class, 'getById']);
Route::get('/eleves/user/note/{userId}', [EleveController::class, 'getByIdlastNoteBYmatire']);
Route::get('/eleves/user/notes/{userId}', [EleveController::class, 'getByIdlastNote']);
Route::put('/eleves/devoirs/{eleveId}/{devoirId}', [EleveController::class, 'updateValidationDevoir']);


//parent 
Route::get('/parent', [ParentController::class, 'showparent']);
Route::get('/parents', [ParentController::class, 'index']);
Route::post('/parents', [ParentController::class, 'store']);
Route::get('/parents/create', [ParentController::class, 'create']);
Route::post('/parents/{parentId}/eleves', [ParentController::class, 'associateEleve']);

// 
// routes/api.php
Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);

//prof
Route::get('/professeurs', [ProfesseurController::class, 'index']);
Route::get('/parents/eleves', [ParentEleveController::class, 'index']);
Route::post('/parents/eleves', [ParentEleveController::class, 'store']);
Route::get('/parents/user/{userId}', [ParentController::class, 'getById']);

// matiers 
Route::get('/matieres', [MatiereController::class, 'index']);
Route::post('/matieres', [MatiereController::class, 'store']);
Route::get('/matieres/{id}', [MatiereController::class, 'show']);
Route::get('/matieres/{id}/download', [MatiereController::class, 'download']);
// moyen 
Route::post('/averages', [AverageController::class, 'calculateAverages']);
Route::get('/download-pdf/{filename}', [MatiereController::class, 'downloadPdf']);
Route::get('/professeurs/{id}', [ProfesseurController::class, 'getById']);

// classes
Route::get('/groupes', [GroupeController::class, 'index']);
Route::post('/groupes', [GroupeController::class, 'store']);
Route::post('/niveau-scolaire/{niveauScolaireId}', [GroupeController::class, 'addGroupe']);
Route::get('/groupes/{groupId}/eleves',  [GroupeController::class, 'getGroupStudents']);

//payement
Route::post('/payements', [PayementsdemoiController::class, 'store']);
Route::get('/payements', [PayementsdemoiController::class, 'index']);
Route::get('/payment/parent', [ParentController::class, 'index']);
Route::get('/payment-rates', [PayementsdemoiController::class, 'fetchPaymentRates']);


//classes and matiers relation 
Route::get('/classe_matiere', [ClasseMatiereController ::class, 'index']);

// vireemnet 
Route::get('/bankinformations', [Bankinformation_ProfController ::class, 'index']);
Route::post('/bankinformations', [Bankinformation_ProfController ::class, 'store']);
Route::post('/virements', [VirementController ::class, 'store']);
Route::post('/activities', [ActivityController::class, 'store']);
Route::delete('/activities/{id}', [ActivityController::class, 'destroy']);



//textbook prof
Route::put('/textbooks/{id}', [TextbookController::class, 'update']);
Route::delete('/textbooks/{id}', [TextbookController::class, 'destroy']);
Route::get('/textbooks', [TextbookController::class, 'index']);
Route::get('/textbooks/{id}', [TextbookController::class, 'show']);
Route::post('/textbooks', [TextbookController::class, 'store']) ;
Route::get('/textbooks/getbyProf/{ProfId}', [TextbookController::class, 'gettextbookbyidprof']) ;


//users
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);



//Calendrie
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);



//emploi temps
Route::post('/emplois', [EmploiTempController::class, 'store']);
Route::get('/emplois/Professeur/{MatiereId}', [EmploiTempController::class, 'getEmploiProf']);
Route::get('/emplois', [ EmploiTempController::class, 'getSchedulesByGroup']);
Route::get('/emplois/groupe/{EmploiId}', [EmploiTempController::class, 'getEmplois']);



// groupes
Route::get('/groupes', [GroupeController::class, 'index']);
Route::post('/groupes', [GroupeController::class, 'store']);
Route::post('/niveau-scolaire/{niveauScolaireId}', [GroupeController::class, 'addGroupe']);
Route::get('/api/groupe/last-carnets-notes-for-prof', [CarnetNoteController::class, 'getLastCarnetsNotesForProf']);




//salaire
Route::get('/table-mois-salaires', [SalaireController::class, 'index']);
Route::post('/payements', [PayementsdemoiController::class, 'store']);	
Route::get('/payements', [PayementsdemoiController::class, 'index']);
Route::get('/payements', [SalaireController::class, 'index']);
Route::get('/eleves/contenus-cahiers-notes/{userId}', [EleveController::class, 'getContenusCahiersNotes']);


//devoir
// Route::get('/devoirs', [DevoirController::class, 'index'])->name('devoir.index');
// Route::post('/devoirs', [DevoirController::class, 'store'])->name('devoir.store');
// Route::put('/devoirs/{id}/valider', [DevoirController::class, 'validerDevoir'])->name('devoir.valider');



//payement
Route::post('/payments', [PayementsdemoiController::class, 'store']);
Route::post('/salaires', [SalaireController::class, 'store']);
Route::get('/payment/details', [PayementsdemoiController::class, 'index']);
Route::get('/parents/{parentId}/bankinfo_parent', [Bankinformation_ParentController::class, 'getBankInfoByParentId']);
Route::get('/payment/bank_information_parent', [Bankinformation_ParentController ::class, 'index']);
Route::get('/ salaire/bank_information_prof', [Bankinformation_ProfController::class, 'index']);
Route::get('/salaire/details', [SalaireController::class, 'index']);
Route::get('/payment/user', [UserController::class, 'index']);
Route::get('/salaire/user', [UserController::class, 'index']);
Route::get('/professeurs/{ProfesseurId}/bankinfo_prof', [Bankinformation_ProfController::class, 'getBankInfoByProfesseurId']);


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
//cours
Route::get('/cours/getbyProf/{ProfId}', [CoursDevoirsController::class, 'getcoursbyidprof']) ;
Route::post('/coursEE', [CoursDevoirsController::class, 'store']) ;
Route::get('/carnetnotes/create/{professeurId}', [CoursDevoirsController::class, 'create']);
Route::get('/telecharger-fichier//{id}/{nomFichier}', [CoursDevoirsController::class, 'telechargerFichier']) ;



//devoir
Route::get('/devoirs/getbyProf/{ProfId}', [DevoirController::class, 'getcoursbyidprof']) ;
Route::post('/devoirEE', [DevoirController::class, 'store']) ;
Route::get('/carnetnotes/create/{professeurId}', [DevoirController::class, 'create']);
Route::get('/telecharger-fichier//{id}/{nomFichier}', [DevoirController::class, 'telechargerFichier'])->name('telecharger.fichier');
  
// notess 
Route::post('/notes', [NoteController::class, 'store']);
Route::post('/lastnotes/{eleveId}', [EleveController::class, 'getByIdlastNote']);

//exams 
Route::post('/exams', [ExamController::class, 'store']);
Route::get('/exams/moyenne/{GroupeId}', [ExamController::class, 'calculerMoyenneParMatiere']);
Route::post('/relation-exam-eleve', [EleveExamController::class, 'store']);

// carnet 
 Route::get('/carnetnotes/create/{professeurId}', [CarnetNoteController::class, 'create']) ;
 Route::get('/carnetnotes/getbyProf/{ProfId}', [CarnetNoteController::class, 'getcarnetnotebyidprof']) ;
Route::post('/carnetnotes', [CarnetNoteController::class, 'store']) ;
Route::post('/payements', [PayementsdemoiController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'v1'], function () {
    //Auth routes
    Route::group(['prefix' => 'auth', 'name' => 'auth.'], function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth:sanctum');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/user', [AuthController::class, 'user'])->name('user');
    });
 });

