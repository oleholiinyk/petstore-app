<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface PetStoreProvider
{
    public function find(int $id);
    public function findByStatus(string $status);
    public function create(array $params);

    public function update(int $id, array $params);

    public function delete(int $id);
    public function uploadImage(int $id, UploadedFile $file);
}
