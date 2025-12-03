<?php

use Illuminate\Support\Facades\Route;
use lumensolucoes\filamentasaas\Http\Controllers\WebhookController;

Route::post('/asaas/webhook', [WebhookController::class, 'handle']);
