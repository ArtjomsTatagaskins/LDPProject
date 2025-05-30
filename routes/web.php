<?php

use App\Http\Controllers\PipelineController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('/pipelines', [PipelineController::class, 'getPipelines']);
Route::get('/statistics', [StatisticsController::class, 'view'])->name('statistics');

