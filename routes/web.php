<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoordinateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProfesseurModuleController;
use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\TypeCoursController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\ReportDeSeanceController;
use App\Http\Controllers\JustificationAbsenceController;
use App\Http\Controllers\ParentEtudiantController;
use App\Http\Controllers\ParentModelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboard-admin'))->name('admin.dashboard');
    Route::get('/coordinateur/dashboard', fn() => view('dashboard-coordinateur'))->name('coordinateur.dashboard');
    Route::get('/professeur/dashboard', fn() => view('dashboard-professeur'))->name('professeur.dashboard');
    Route::get('/etudiant/dashboard', fn() => view('dashboard-etudiant'))->name('etudiant.dashboard');
    Route::get('/parent/dashboard', fn() => view('dashboard-parent'))->name('parent.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Routes pour les éléments que deux ou plusieurs rôles peuvent utiliser à la fois
Route::middleware(['auth', 'role:admin,coordinateur'])->group(function () {
    Route::resource('classes', ClasseController::class)->parameters(['classes' => 'classe']);
    Route::resource('modules', ModuleController::class);
});

//Routes réservées à  l'ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('coordinateurs', CoordinateurController::class);
    Route::resource('professeurs', ProfesseurController::class);
    Route::resource('professeur_modules', ProfesseurModuleController::class);
    Route::resource('etudiants', EtudiantController::class);
    Route::resource('parent_models', ParentModelController::class);
    Route::resource('annees', AnneeController::class);
    Route::resource('annee_academiques', AnneeAcademiqueController::class);
    Route::resource('niveaux', NiveauController::class);
    Route::resource('type_cours', TypeCoursController::class);
    Route::resource('parents', ParentEtudiantController::class);
});

// Routes réservées au COORDINATEUR
Route::middleware(['auth', 'coordinateur'])->group(function () {
    Route::resource('emploi_du_temps', EmploiDuTempsController::class)->parameters(['emploi_du_temps' => 'emploi_du_temp']);
    Route::resource('seances', SeanceController::class);
    Route::resource('presences', PresenceController::class);
    Route::get('seances/{seance}/presences', [PresenceController::class, 'marquerPresence'])->name('presences.marquer');
    Route::post('seances/{seance}/presences', [PresenceController::class, 'enregistrerPresence'])->name('presences.enregistrer');
    Route::resource('report_de_seances', ReportDeSeanceController::class);
    Route::resource('justifications', JustificationAbsenceController::class);
});

// Routes réservées au PROFESSEUR
Route::middleware(['auth', 'professeur'])->prefix('professeur')->group(function () {

    Route::get('emploi', [ProfesseurController::class, 'emploi'])->name('professeur.emploi');
    Route::get('seances', [ProfesseurController::class, 'seances'])->name('professeur.seances');
    Route::get('modules', [ProfesseurController::class, 'modules'])->name('professeur.modules');

    // Routes pour marquer et enregistrer les présences (spécifiques au prof)
    Route::get('seances/{seance}/presence', [ProfesseurController::class, 'marquerPresence'])
        ->name('professeurs.marquer');
    Route::post('seances/{seance}/presence', [ProfesseurController::class, 'enregistrerPresence'])
        ->name('professeurs.enregistrer');
});


// Routes réservées à l'ÉTUDIANT
Route::middleware(['auth', 'etudiant'])->prefix('etudiant')->group(function () {
    Route::get('absences', [EtudiantController::class, 'absences'])->name('etudiant.absences');
    Route::get('justifications', [EtudiantController::class, 'justifications'])->name('etudiant.justifications');
    Route::get('emploi', [EtudiantController::class, 'emploi'])->name('etudiant.emploi');
});


// Routes réservées au PARENT
Route::middleware(['auth', 'parent'])->prefix('parent')->group(function () {
    Route::get('enfants', [ParentModelController::class, 'enfants'])->name('parent.enfants');
    Route::get('absences', [ParentModelController::class, 'absences'])->name('parent.absences');
    Route::get('justifications', [ParentModelController::class, 'justifications'])->name('parent.justifications');
    Route::get('emploi', [ParentModelController::class, 'emploi'])->name('parent.emploi');
    Route::get('/test-parent', function () {
    return 'Bienvenue parent 🎉';
})->middleware(['auth', 'parent']);

});


Route::get('/test-users', function () {
    return 'Ça fonctionne 🎉';
});



require __DIR__ . '/auth.php';
