<?php
use App\Http\Controllers\MyScheduleController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/mi-agenda', [MyScheduleController::class, 'index'])->name('my-schedule');
    Route::get('/mi-agenda/crear', [MyScheduleController::class, 'create'])->name('my-schedule.create');
    Route::post('/mi-agenda', [MyScheduleController::class, 'store'])->name('my-schedule.store');
    Route::delete('/mi-agenda/{scheduler}', [MyScheduleController::class, 'destroy'])->name('my-schedule.destroy');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-schedule', function () {
    return view('my-schedule.index');
})->middleware(['auth', 'verified'])->name('my-schedule'); */

require __DIR__.'/auth.php';
