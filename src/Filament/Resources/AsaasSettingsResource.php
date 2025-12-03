<?php

namespace LumenSolucoes\FilamentAsaas\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use lumensolucoes\FilamentAsaas\Models\AsaasAccount;

class AsaasSettingsResource extends Resource
{
    protected static ?string $model = AsaasAccount::class;

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            TextInput::make('api_key')->required()->label('API Key'),
            Select::make('environment')->options(['sandbox' => 'Sandbox', 'production' => 'Production'])->required(),
            TextInput::make('tenant_id')->label('Tenant ID (nullable)'),
        ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('id'),
            \Filament\Tables\Columns\TextColumn::make('tenant_id'),
            \Filament\Tables\Columns\TextColumn::make('environment'),
            \Filament\Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAsaasAccounts::route('/'),
        ];
    }
}
