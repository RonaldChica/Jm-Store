<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecargaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('recargas', RecargaController::class)
    ->middleware(['auth', 'verified'])
    ->except(['create']);

Route::resource('topics', TopicController::class)
    ->middleware(['auth', 'verified'])
    ->except(['create']);

Route::resource('products', ProductController::class)
    ->middleware(['auth', 'verified'])
    ->except(['create']);

Route::resource('deposits', DepositController::class)
    ->middleware(['auth', 'verified'])
    ->except(['create']);

Route::resource('banks', BankController::class)
    ->middleware(['auth', 'verified'])
    ->except(['create']);

Route::resource('questions', QuestionController::class)
    ->middleware(['auth', 'verified'])
    ->only(['store', 'update', 'destroy']);

Route::resource('users', UserController::class)
    ->middleware(['auth', 'verified'])
    ->only(['index', 'show']);

require __DIR__ . '/auth.php';
