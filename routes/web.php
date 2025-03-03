<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('salaries', SalaryController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('expenses', ExpenseController::class);

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
