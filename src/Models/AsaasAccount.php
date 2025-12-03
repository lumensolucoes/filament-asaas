<?php

namespace lumensolucoesFilamentAsaas\Models;

use Illuminate\Database\Eloquent\Model;

class AsaasAccount extends Model
{
    protected $table = 'asaas_accounts';

    protected $fillable = [
        'tenant_id',
        'api_key',
        'environment',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
