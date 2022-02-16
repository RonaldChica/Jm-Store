<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/auth/redirect', [SocialiteLoginController::class, 'redirect'])
                ->middleware('guest')
                ->name('socialite.redirect');

Route::get('/auth/callback', [SocialiteLoginController::class, 'callback'])
                ->middleware('guest')
                ->name('socialite.callback');