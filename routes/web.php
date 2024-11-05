<?php
use App\Http\Controllers\Loan_Detail_Controller;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/loan-details', [Loan_Detail_Controller::class, 'showLoanDetails'])->name('loan.details');
    Route::get('/process-emi', [Loan_Detail_Controller::class, 'processEmiDetails'])->name('process.emi');
});