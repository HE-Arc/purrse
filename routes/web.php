<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invitation\InvitationController;
use Inertia\Inertia;

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
    return Inertia::render('Application/Home');
});

Route::get('/mainboard', function () {
    return Inertia::render('Application/Mainboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return Inertia::render('Application/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/invite/{token}', [InvitationController::class, 'create'])->middleware(['auth', 'verified']);

Route::get('/accept/{token}', [InvitationController::class, 'accept'])->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
