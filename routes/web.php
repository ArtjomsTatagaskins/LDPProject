<?php

use App\Http\Controllers\PipelineController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/pipelines', [PipelineController::class, 'getPipelines']);
Route::get('/home', [PipelineController::class, 'getPipelines'])->name('home');
Route::get('/statistics', [StatisticsController::class, 'view'])->name('statistics');
Route::get('/statistics-data', [StatisticsController::class, 'apiData']);
