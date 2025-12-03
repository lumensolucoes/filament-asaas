# Filament Asaas Integration

Plugin to integrate Asaas payments into a Filament admin panel, with support for card, debit, PIX and boleto, and multi-tenancy.

Quick install

1. Require package via composer (from path):

```bash
composer require lumensolucoes/filament-asaas --prefer-dist
```

2. Publish config and run migrations:

```bash
php artisan vendor:publish --provider="lumensolucoes\\filamentasaas\\AsaasServiceProvider" --tag=config
php artisan migrate
```

3. Set `ASAAS_ENV`, `ASAAS_API_KEY` and `ASAAS_WEBHOOK_SECRET` in `.env` or create tenant-specific accounts via the Filament settings resource.

Notes
- The package provides a tenant resolver hook in `config/asaas.php`. Set it to a callable that returns the current tenant id.
- Webhook route is available at `/asaas/webhook` and will update `asaas_payments` records.
