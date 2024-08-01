<?php

namespace App\Providers\PetStoreProviders;

use App\Exceptions\PetStoreException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class RequestHandler
{
    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function get(string $route, array $params = []): array
    {
        return $this->sendRequest('get', $route, $params);
    }

    public function post(string $route, array $params = []): array
    {
        return $this->sendRequest('post', $route, $params);
    }

    public function put(string $route, array $params = []): array
    {
        return $this->sendRequest('put', $route, $params);
    }

    public function delete(string $route, array $params = [])
    {
        return $this->sendRequest('delete', $route, $params);
    }

    /**
     * @throws PetStoreException
     */
    protected function sendRequest(string $method, string $route, array $params = [])
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'api_key' => $this->apiKey
        ])->{$method}($this->prepareUrl($route), $params);

        if ($response->failed()) {
            $this->handleFailedResponse($response);
        }

        return $response->json();
    }

    private function prepareUrl(string $route): string
    {
        return config('services.petstore.api_base_url') . '/' . ltrim($route, '/');
    }

    private function handleFailedResponse($response)
    {
        $body = json_decode($response->body(), true);

        $message = $body['message'] ?? 'Resource not found';

        throw new PetStoreException($message, $response->status());
    }
}
