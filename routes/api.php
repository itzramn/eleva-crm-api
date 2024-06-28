<?php

use App\Http\Controllers\ProspectControlller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Prospects
Route::get('/prospects', [ProspectControlller::class, 'index']);
Route::get('/prospects/{id}', [ProspectControlller::class, 'show']);
Route::post('/prospects', [ProspectControlller::class, 'store']);
Route::put('/prospects/{id}', [ProspectControlller::class, 'update']);
Route::delete('/prospects/{id}', [ProspectControlller::class, 'destroy']);
