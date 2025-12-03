<?php

namespace lumensolucoes\filamentasaas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use lumensolucoes\filamentasaas\Models\AsaasPayment;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        // Basic handling: find payment by asaas id and update status/metadata
        $asaasId = $payload['id'] ?? $payload['paymentId'] ?? null;

        if ($asaasId) {
            $payment = AsaasPayment::where('asaas_id', $asaasId)->first();
            if ($payment) {
                $payment->status = $payload['status'] ?? $payment->status;
                $payment->metadata = array_merge($payment->metadata ?? [], $payload);
                $payment->save();
            }
        }

        return response()->json(['received' => true]);
    }
}
