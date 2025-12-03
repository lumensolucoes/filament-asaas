<?php

namespace lumensolucoesFilamentAsaas\Filament\Resources;

use Filament\Resources\Resource;
use lumensolucoesFilamentAsaas\Models\AsaasPayment;

class AsaasPaymentResource extends Resource
{
    protected static ?string $model = AsaasPayment::class;

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('id'),
            \Filament\Tables\Columns\TextColumn::make('asaas_id'),
            \Filament\Tables\Columns\TextColumn::make('amount'),
            \Filament\Tables\Columns\TextColumn::make('status'),
            \Filament\Tables\Columns\TextColumn::make('method'),
            \Filament\Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \Filament\Resources\Pages\ListRecords::route('/'),
        ];
    }
}
