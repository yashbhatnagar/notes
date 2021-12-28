<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes go in the group.
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/notes', [NotesController::class, 'index']);
    Route::get('/notes/{id}', [NotesController::class, 'show']);
    Route::get('/notes/search/{name}', [NotesController::class, 'search']);
    Route::post('/notes', [NotesController::class, 'store']);
    Route::put('/notes/{id}', [NotesController::class, 'update']);
    Route::delete('/notes/{id}', [NotesController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
