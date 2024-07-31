<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/form/{page}', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form/{page}', [FormController::class, 'submitForm'])->name('form.submit');
