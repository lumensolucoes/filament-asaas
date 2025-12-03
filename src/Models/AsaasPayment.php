<?php

namespace lumensolucoes\filamentasaas\Models;

use Illuminate\Database\Eloquent\Model;

class AsaasPayment extends Model
{
    protected $table = 'asaas_payments';

    protected $fillable = [
        'asaas_id',
        'tenant_id',
        'account_id',
        'amount',
        'currency',
        'status',
        'method',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:2',
    ];
}
