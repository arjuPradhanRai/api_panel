<?php

use App\Models\SubCategorey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\DataController;

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
Route::post('register',[ApiController::class,'register']);
Route::get('index',[ApiController::class,'index']);
Route::get('show/{id}',[ApiController::class,'show']);
Route::put('index/{id}/update',[ApiController::class,'update']);
Route::delete('index/{id}/delete',[ApiController::class,'delete']);



// Category

Route::post('add_category',[DataController::class,'addCategory']);
Route::get('show_category',[DataController::class,'index']);
Route::put('index/{id}/update_category',[DataController::class,'update']);

// Add Subcategory
Route::post('add_subcategory',[DataController::class,'addsubCategory']);

// Products
Route::post('add_product',[DataController::class,'addProduct']);
Route::get('show_product',[DataController::class,'showProduct']);
Route::post('index/{id}/update_product',[DataController::class,'updateProduct']);








