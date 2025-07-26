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
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\TypeCoursController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\ReportDeSeanceController;
use App\Http\Controllers\JustificationAbsenceController;
use App\Http\Controllers\ParentEtudiantController;
use App\Http\Controllers\ParentModelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('coordinateurs', CoordinateurController::class);
    Route::resource('classes', ClasseController::class)->parameters(['classes' => 'classe']);
    Route::resource('modules', ModuleController::class);
    Route::resource('professeurs', ProfesseurController::class);
    Route::resource('professeur_modules', ProfesseurModuleController::class);
    Route::resource('annees', AnneeController::class);
    Route::resource('annee_academiques', AnneeAcademiqueController::class);
    Route::resource('niveaux', NiveauController::class);
    Route::resource('type_cours', TypeCoursController::class);
    Route::resource('emploi_du_temps', EmploiDuTempsController::class);
    Route::resource('seances', SeanceController::class);
    Route::resource('report_de_seances', ReportDeSeanceController::class);
    Route::resource('presences', PresenceController::class);
    Route::resource('justifications', JustificationAbsenceController::class);
    Route::resource('parent_models', ParentModelController::class);
    Route::resource('parents', ParentEtudiantController::class);
});

Route::get('/test-users', function () {
    return 'Ça fonctionne 🎉';
});



require __DIR__ . '/auth.php';
