<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invitation\InvitationController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SpaceController;
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

Route::get('/mainboard', [ListController::class, 'create'])->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return Inertia::render('Application/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/lists', [ListController::class, 'create'])->middleware(['auth', 'verified']);

/*
|--------------------------------------------------------------------------
| Web routes to invitation system
|--------------------------------------------------------------------------
*/
Route::get('/invite/{token}', [InvitationController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/accept/{token}', [InvitationController::class, 'accept'])->middleware(['auth', 'verified']);

/*
|--------------------------------------------------------------------------
| Web routes to CRUD List table
|--------------------------------------------------------------------------
*/
Route::post('newList', [ListController::class, 'createNewList']);
Route::post('updateList', [ListController::class, 'updateList']);
Route::post('deleteList', [ListController::class, 'deleteList']);

/*
|--------------------------------------------------------------------------
| Web routes to CRUD Space table
|--------------------------------------------------------------------------
*/
Route::post('newSpace', [SpaceController::class, 'createNewSpace']);
Route::post('updateSpace', [SpaceController::class, 'updateSpace']);
Route::post('deleteSpace', [SpaceController::class, 'deleteSpace']);

require __DIR__ . '/auth.php';
