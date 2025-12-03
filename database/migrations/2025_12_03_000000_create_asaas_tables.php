<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('asaas_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->nullable()->index();
            $table->string('api_key')->nullable();
            $table->string('environment')->default('sandbox');
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('asaas_payments', function (Blueprint $table) {
            $table->id();
            $table->string('asaas_id')->nullable()->index();
            $table->string('tenant_id')->nullable()->index();
            $table->foreignId('account_id')->nullable()->constrained('asaas_accounts')->nullOnDelete();
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('currency')->nullable()->default('BRL');
            $table->string('status')->nullable();
            $table->string('method')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asaas_payments');
        Schema::dropIfExists('asaas_accounts');
    }
};
