<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GithubController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    //calling all user in github
    Route::get('/github/user', [GithubController::class, 'github_user']);
    Route::get('/github', [GithubController::class, 'index']);
});
// login api
Route::post('/github/users/register', [AuthController::class, 'register']);
Route::post('/github/users/login', [AuthController::class, 'login']);
