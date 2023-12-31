<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\InvoiceController;
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
Route::get('student', [StudentController::class, 'index'] );
Route::post('student', [StudentController::class, 'store']);
Route::get('student/{id}', [StudentController::class, 'show']);
Route::get('student/{id}/edit', [StudentController::class, 'edit']);
Route::put('student/{id}/edit', [StudentController::class, 'update']);
Route::delete('student/{id}/delete', [StudentController::class, 'destroy']);

Route::group(['prefix' => 'v1', 'namespace' =>'App\Http\Controllers\api'],function(){
 Route::apiResource('customers', CustomerController::class);
 Route::apiResource('invoices', InvoiceController::class);
});
