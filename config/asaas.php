<?php

return [
    // Global API key (used when no tenant-specific account is resolved)
    'api_key' => env('ASAAS_API_KEY', null),

    // environment: 'sandbox' or 'production'
    'environment' => env('ASAAS_ENV', 'sandbox'),

    // Base URIs for Asaas
    'base_uri' => [
        'sandbox' => 'https://sandbox.asaas.com/api/v3',
        'production' => 'https://www.asaas.com/api/v3',
    ],

    // Tenant resolver: a callable that returns the current tenant id (or null)
    // You can set this value in a service provider: config(['asaas.tenant_resolver' => function () { return auth()->user()->tenant_id ?? null; }]);
    'tenant_resolver' => null,

    // Webhook secret validation (optional)
    'webhook_secret' => env('ASAAS_WEBHOOK_SECRET', null),
];
