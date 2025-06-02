<?php

use App\Http\Controllers\GitLabController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [GitLabController::class, 'getProjects'])->name('home');
Route::get('/statistics', [StatisticsController::class, 'view'])->name('statistics');
Route::get('/statistics-data', [StatisticsController::class, 'apiData']);
Route::get('/logs', [App\Http\Controllers\LogsController::class, 'index'])->name('logs');
Route::get('/logs', [LogsController::class, 'index'])->name('logs');
Route::get('/logs/data', [LogsController::class, 'data'])->name('logs.data');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::get('/settings', [SettingsController::class, 'view'])->name('settings');
