<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FundraiserApiController;
use App\Http\Controllers\Api\ContainersController;
use App\Http\Controllers\Api\NewsletterSubscriptionController;
use App\Http\Controllers\Api\TotalUsersController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\CharityApiController;
use App\Http\Controllers\Api\MaterialApiController;
use App\Http\Controllers\Api\ServicesApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/total/users', [TotalUsersController::class, 'countTotalUsers']);
Route::post('/newsletter/subscribe', [NewsletterSubscriptionController::class, 'subscribe']);

Route::get('fundraisers/list', [FundraiserApiController::class, 'fundraisersList']);
Route::get('total/containers', [ContainersController::class, 'containers']);
// Route::middleware('auth:api')->post('/subscribe', [NewsletterSubscriptionController::class, 'subscribe']);
Route::get('charity/types', [CharityApiController::class, 'index']);
Route::get('blogs/list', [BlogApiController::class, 'index']);
Route::get('meterials/collects', [MaterialApiController::class, 'index']);
Route::get('our/services', [ServicesApiController::class, 'index']);
