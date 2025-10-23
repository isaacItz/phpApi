<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PawnReactivationRulesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', [PawnReactivationRulesController::class,'index']);
Route::post('/store' , [PawnReactivationRulesController::class,'store']);
Route::get('/findByStore/{storeId}', [PawnReactivationRulesController::class, 'findByStore']);
Route::get('/searchByFields', [PawnReactivationRulesController::class, 'searchByFields']);
Route::get('/findByMinLoanOrAuction', [PawnReactivationRulesController::class, 'findByMinLoanOrAuction']);