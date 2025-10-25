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

Route::prefix('logbook')->group(function () {
    Route::get('/resume', function () {
        return view('logbook.resume');
    })->name('logbook.resume');

    Route::get('/list', function () {
        return view('logbook.list');
    })->name('logbook.list');

    Route::get('/jobs', function () {
        return view('logbook.jobs');
    })->name('logbook.jobs');

    Route::get('/logbook', function () {
        return view('logbook.logbooksection');
    })->name('logbook.logbook');
});

Route::get('/', function () {
    return redirect()->route('logbook.resume');
});