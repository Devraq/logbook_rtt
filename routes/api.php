<?php
// routes/api.php (add these; file already has prefix /api)
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\LogController;
use App\Http\Controllers\Api\ActivityController;

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/logs', [LogController::class, 'index']);
Route::post('/jobs/{job}/logs', [LogController::class, 'store']);

Route::patch('/activities/{activity}', [ActivityController::class, 'update']);
