<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FilterRSIController;
use App\Http\Controllers\PasienRSIController;

Route::get('/tes', [PatientController::class, 'index']);
Route::get('/get-filters', [FilterController::class, 'getFilters']);
Route::get('/get-patients', [PatientController::class, 'getPatients']);

Route::get('/rsi', [PasienRSIController::class, 'index']);
Route::get('/get-filtersRSI', [FilterRSIController::class, 'ambilDataFilter']);
route::get('/get-patientsRSI', [PasienRSIController::class, 'ambilDataPasien']);

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/get-patients', [PatientController::class, 'getPatients']);
?>