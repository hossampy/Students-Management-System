<?php

use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EtudiantController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/contact', function () {
    return Inertia::render('contact');
})->name('contact');

Route::resource('etudiant', EtudiantController::class);

Route::resource('niveauScolaire', NiveauScolaireController::class);




require __DIR__.'/auth.php';
