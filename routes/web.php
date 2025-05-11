<?php

use App\Http\Controllers\PipelineController;

Route::get('/pipelines', [PipelineController::class, 'getPipelines']);

