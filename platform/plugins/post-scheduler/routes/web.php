<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
// use Botble\post-scheduler\Http\Controllers\PostSchedulerController;
// use Botble\Services\Http\Controllers\PostController;

// use Botble\Services\Http\Controllers\ServicesPostController;

Route::post('/post-scheduler/store', [PostSchedulerController::class, 'store'])->name('your.route.store');
