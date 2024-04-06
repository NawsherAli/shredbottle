<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FundraiserApiController;
use App\Http\Controllers\Api\ContainersController;
use App\Http\Controllers\API\NewsletterSubscriptionController;

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
Route::post('/subscribe', [NewsletterSubscriptionController::class, 'subscribe']);

Route::get('fundraisers/list', [FundraiserApiController::class, 'fundraisersList']);
Route::get('total/containers', [ContainersController::class, 'containers']);
// Route::middleware('auth:api')->post('/subscribe', [NewsletterSubscriptionController::class, 'subscribe']);
