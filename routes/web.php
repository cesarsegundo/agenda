<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MyScheduleController;
use App\Http\Controllers\OpeningHoursController;
use App\Http\Controllers\StaffScheduleController;
use App\Http\Controllers\UsersServicesController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:cliente')
        ->prefix('/mi-agenda')
        ->group(function () {
            Route::get('/', [MyScheduleController::class, 'index'])
                ->name('my-schedule');

            Route::get('/crear', [MyScheduleController::class, 'create'])
                ->name('my-schedule.create');

            Route::get('/{scheduler}/edit', [MyScheduleController::class, 'edit'])
                ->name('my-schedule.edit');

            Route::post('/', [MyScheduleController::class, 'store'])
                ->name('my-schedule.store');

            Route::put('/{scheduler}', [MyScheduleController::class, 'update'])
                ->name('my-schedule.update');

            Route::delete('/{scheduler}', [MyScheduleController::class, 'destroy'])
                ->name('my-schedule.destroy');
        });

    Route::middleware('role:personal')->group(function () {
        Route::get('/staff-agenda', [StaffScheduleController::class, 'index'])
            ->name('staff-scheduler.index');

        Route::get('/staff-agenda/{scheduler}/edit', [StaffScheduleController::class, 'edit'])
            ->name('staff-scheduler.edit');

        Route::put('/staff-agenda/{scheduler}', [StaffScheduleController::class, 'update'])
            ->name('staff-scheduler.update');

        Route::delete('/staff-agenda/{scheduler}', [StaffScheduleController::class, 'destroy'])
            ->name('staff-scheduler.destroy');
    });
    Route::middleware('role:admin')->group(function () {
        Route::get('/usuarios', [UsersController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}/edit', [UsersController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UsersController::class, 'update'])
            ->name('users.update');

        Route::get('/usuarios/{user}/services/edit', [UsersServicesController::class, 'edit'])
            ->name('users-services.edit');

        Route::put('/usuarios/{user}/services', [UsersServicesController::class, 'update'])
            ->name('users-services.update');

        Route::get('/opening-hours/edit', [OpeningHoursController::class, 'edit'])
            ->name('opening-hours.edit');

        Route::put('/opening-hours/update', [OpeningHoursController::class, 'update'])
            ->name('opening-hours.update');
    });
});

require __DIR__.'/auth.php';
