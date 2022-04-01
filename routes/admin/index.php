<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\GlobalSearchController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [HomeController::class, 'index'])->name('main');
Route::get('/search', [GlobalSearchController::class, 'index'])->name('globalSearch');

