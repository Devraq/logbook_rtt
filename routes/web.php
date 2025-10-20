<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LogbookController;

if (app()->environment('production')) {
    Route::middleware(['auth'])->group(function () {
        Route::get('/logbook', [LogbookController::class,'index'])->name('logbook.index');
    });
} else {
    Route::get('/logbook', [LogbookController::class,'index'])->name('logbook.index');
}

