<?php

namespace lumensolucoesFilamentAsaas;

use GuzzleHttp\Client as GuzzleClient;
use lumensolucoesFilamentAsaas\Models\AsaasAccount;

class AsaasClient
{
    protected array $config;
    protected GuzzleClient $http;

    public function __construct(array $config = [])
    {
        $this->config = array_merge(require __DIR__ . '/../config/asaas.php', $config);
        $this->http = new GuzzleClient([
            'base_uri' => $this->getBaseUrl(),
            'timeout' => 15,
        ]);
    }

    protected function getBaseUrl(): string
    {
        return $this->config['environment'] === 'production'
            ? $this->config['base_uri']['production']
            : $this->config['base_uri']['sandbox'];
    }

    protected function resolveApiKey(): ?string
    {
        // If tenant resolver provided, try resolving a tenant-scoped account
        if (is_callable($this->config['tenant_resolver'])) {
            $tenantId = call_user_func($this->config['tenant_resolver']);
            if ($tenantId) {
                $account = AsaasAccount::where('tenant_id', $tenantId)->latest()->first();
                if ($account && $account->api_key) {
                    return $account->api_key;
                }
            }
        }

        // Fall back to global API key from config
        return $this->config['api_key'] ?? null;
    }

    protected function headers(): array
    {
        $apiKey = $this->resolveApiKey();
        $headers = [
            'Content-Type' => 'application/json',
        ];
        if ($apiKey) {
            $headers['access_token'] = $apiKey;
        }
        return $headers;
    }

    public function request(string $method, string $uri, array $options = [])
    {
        $options = array_merge($options, ['headers' => $this->headers()]);
        $response = $this->http->request($method, $uri, $options);
        $body = (string) $response->getBody();
        return json_decode($body, true) ?: $body;
    }

    // High-level helpers (lightweight wrappers)
    public function createPayment(array $data)
    {
        return $this->request('POST', '/payments', ['json' => $data]);
    }

    public function getPayment(string $id)
    {
        return $this->request('GET', '/payments/' . $id);
    }

    public function createSubscription(array $data)
    {
        return $this->request('POST', '/subscriptions', ['json' => $data]);
    }
}
