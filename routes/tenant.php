<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'verified',
    'role:tenant',
    'tenant.context',
])
    ->prefix('{tenant:slug}')
    ->scopeBindings()
    ->name('tenant.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('tenant-dashboard');
        })->name('dashboard');
    });
