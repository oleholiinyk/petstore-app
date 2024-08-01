<?php

namespace App\Services;


use App\Contracts\PetStoreProvider;
use App\Enums\PetStatus;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

readonly class PetService
{
    public function __construct(protected PetStoreProvider $petProvider)
    {
    }

    public function find(int $id)
    {
        return $this->petProvider->find($id);
    }

    public function findByStatus(string $status)
    {
        return $this->petProvider->findByStatus($status);
    }

    public function create(Pet $pet)
    {
        DB::transaction(function () use ($pet) {
            $pet->status = PetStatus::AVAILABLE;
            $pet->save();
            $this->petProvider->create($pet->toArray());

            return $pet;
        });
    }

    public function update(int $id, array $data)
    {
        DB::transaction(function () use ($data, $id) {
            $pet = Pet::query()->findOrFail($id);
            $pet->update($data);

            if (isset($data['image']) && $data['image']) {
                $this->petProvider->uploadImage($id, $data['image']);
            }

            $this->petProvider->update($id, $pet->toArray());

            return $pet;
        });
    }

    public function delete(int $id)
    {
        $this->petProvider->delete($id);
        Pet::query()->find($id)->delete();
    }
}
