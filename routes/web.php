<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;


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

    //Loan Controller
    Route::get('/loans', [LoanController::class, 'getLoanDetails'])->name('loans.details');
    Route::get('/process', [LoanController::class, 'getProcessPage'])->name('loans.process');
    Route::get('/processed_data', [LoanController::class, 'getProcessedData'])->name('loans.processed_data');
});

require __DIR__ . '/auth.php';
