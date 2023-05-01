<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::post('logeut',[AuthController::class, 'logeut']);






Route::group(['middleware' => ['jwt.auth']], function () {

    Route::post('suivantPrecedent',[TaskController::class, 'suivantPrecedent']);

    Route::get('getUser',[AuthController::class, 'getUser']);

    Route::get('getProjet/{user_id}',[ProjetController::class, 'getProjet']);
    Route::post('updateTask',[TaskController::class, 'updateTask']);


    Route::get('getProjetById/{projet_id}',[ProjetController::class, 'getProjetById']);

    Route::post('addProject',[ProjetController::class, 'addProject']);


    Route::post('addTask',[TaskController::class, 'addTask']);
    Route::post('deleteTask',[TaskController::class, 'deleteTask']);


});







