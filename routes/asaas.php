<?php

use Illuminate\Support\Facades\Route;
use lumensolucoes\FilamentAsaas\Http\Controllers\WebhookController;

Route::post('/asaas/webhook', [WebhookController::class, 'handle']);
