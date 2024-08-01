<?php

namespace App\Providers\PetStoreProviders;

use App\Contracts\PetStoreProvider;
use App\Exceptions\PetStoreException;
use Illuminate\Http\UploadedFile;

class Pet implements PetStoreProvider
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client(config('services.petstore.api_key'));
    }

    public function find(int $id): array
    {
        $pet = $this->client->request()->get("pet/{$id}");

        return $pet;
    }

    public function findByStatus(string $status): array
    {
        $pet = $this->client->request()->get("pet/findByStatus", ['status' => $status]);

        if (!$pet) {
            throw new PetStoreException('Pet not found');
        }

        return $pet;
    }

    public function create(array $params = []): array
    {
        $pet = $this->client->request()->post("pet", $params);

        if (!$pet) {
            throw new PetStoreException('Could not create pet');
        }

        return $pet;
    }

    public function update(int $id, array $params = []): array
    {
        return $this->client->request()->put("pet", $params);
    }

    public function delete(int $id)
    {
        return $this->client->request()->delete("pet/{$id}");
    }

    public function uploadImage(int $id, UploadedFile $file): array
    {
        return $this->client->request()->post("pet/{$id}/uploadImage", ['file' => $file]);
    }
}
