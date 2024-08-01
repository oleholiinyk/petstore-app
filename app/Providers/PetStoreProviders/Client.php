<?php

namespace App\Providers\PetStoreProviders;

class Client
{
    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function request(): RequestHandler
    {
        return new RequestHandler($this->apiKey);
    }
}
