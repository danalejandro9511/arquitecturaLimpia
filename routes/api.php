<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{TaskController, CompanyController};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tasks', [TaskController::class, 'create']);
Route::get('/tasks/completed', [TaskController::class, 'completed']);
Route::get('/tasks/pending', [TaskController::class, 'pending']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::patch('/tasks/{id}/toggle-completion', [TaskController::class, 'toggleCompletion']); 

//Route::apiResource('companies', CompanyController::class);

Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/{id}', [CompanyController::class, 'show'])->name('companies.show');
    Route::put('/{id}', [CompanyController::class, 'update'])->name('companies.update');
});