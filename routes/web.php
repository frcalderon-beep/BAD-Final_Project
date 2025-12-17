<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SystemController;

Route::redirect('/', '/staff');

// Resource Routes for CRUD Operations
Route::resource('staff', StaffController::class);
Route::resource('clients', ClientController::class);
Route::resource('service-types', ServiceTypeController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('systems', SystemController::class);
