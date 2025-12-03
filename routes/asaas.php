<?php

use Illuminate\Support\Facades\Route;
use lumensolucoesFilamentAsaas\Http\Controllers\WebhookController;

Route::post('/asaas/webhook', [WebhookController::class, 'handle']);
