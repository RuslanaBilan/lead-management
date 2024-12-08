<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', [LeadController::class, 'create'])->name('leads.create');
Route::post('/store', [LeadController::class, 'store'])->name('leads.store');
Route::get('/statuses', [LeadController::class, 'index'])->name('leads.index');
