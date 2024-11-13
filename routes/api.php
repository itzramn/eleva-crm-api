<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DevelopmentController;
use App\Http\Controllers\FunnelController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ZapierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Availability

//Broker

//Channel
Route::get('/channels', [ChannelController::class, 'index']);
Route::post('/channels', [ChannelController::class, 'create']);
Route::put('/channels', [ChannelController::class, 'update']);
Route::delete('/channels', [ChannelController::class, 'destroy']);

//Development
Route::get('/developments', [DevelopmentController::class, 'index']);
Route::get('/developments', [DevelopmentController::class, 'show']);
Route::put('/developments', [DevelopmentController::class, 'updateAction']);

//Funnel
Route::get('/funnels', [FunnelController::class, 'index']);
Route::post('/funnels', [FunnelController::class, 'create']);
Route::put('/funnels', [FunnelController::class, 'update']);
Route::delete('/funnels', [FunnelController::class, 'destroy']);
Route::get('/funnels', [FunnelController::class, 'getAction']);
Route::put('/funnels', [FunnelController::class, 'updateAction']);


//Prospects
Route::get('/prospects', [ProspectController::class, 'index']);
Route::get('/prospects/{id}', [ProspectController::class, 'show']);
Route::post('/prospects', [ProspectController::class, 'store']);
Route::put('/prospects/{id}', [ProspectController::class, 'update']);
Route::delete('/prospects/{id}', [ProspectController::class, 'destroy']);


//Reason
Route::get('/reasons', [ReasonController::class, 'index']);
Route::post('/reasons', [ReasonController::class, 'create']);
Route::put('/reasons', [ReasonController::class, 'update']);
Route::delete('/reasons', [ReasonController::class, 'destroy']);

//Recovery
Route::get('/recovery', [RecoveryController::class, 'index']);
Route::put('/recovery', [RecoveryController::class, 'update']);

//Reports
Route::get('/reports', [ReportController::class, 'users']);
Route::get('/reports', [ReportController::class, 'prospects']);
Route::get('/reports', [ReportController::class, 'fountainProspects']);
Route::get('/reports', [ReportController::class, 'historyChangesMarketing']);
Route::get('/reports', [ReportController::class, 'findProspectsReport']);

//Zapier
Route::get('/zapier', [ZapierController::class, 'findZapier']);
Route::get('/zapier', [ZapierController::class, 'zapierReport']);
Route::post('/zapier', [ZapierController::class, 'landingSubmitInfo']);
