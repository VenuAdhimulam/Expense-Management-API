<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseManagementController;

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

Route::get('/', [ExpenseManagementController::class, 'index']);

Route::post('/saveExpense', [ExpenseManagementController::class, 'store']);

Route::get('/getAllExpenses', [ExpenseManagementController::class, 'fetch']);

Route::get('/show/{id}', [ExpenseManagementController::class, 'show']);

Route::delete('/deleteExpense/{id}', [ExpenseManagementController::class, 'destroy']);

Route::put('/updateExpense/{id}', [ExpenseManagementController::class, 'update']);
