<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindByStatusPetRequest;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PetController extends Controller
{
    public function list()
    {
        $pets = QueryBuilder::for(Pet::class)
            ->allowedFilters(['status'])
            ->get();

        return view('pets.index', compact('pets'));
    }

    public function find(Request $request, PetService $petService)
    {
        $pet = $petService->find($request->route('id'));

        return view('pets.show', compact('pet'));
    }

    public function findByStatus(FindByStatusPetRequest $request, PetService $petService)
    {
        $pets = $petService->findByStatus($request->get('status'));

        return view('pets.index', compact('pets'));

    }

    public function store(StorePetRequest $request, PetService $petService): RedirectResponse
    {
        $petService->create(new Pet($request->validated()));

        return redirect()->route('pets.index')
            ->with('success', 'Pet created successfully.');
    }

    public function edit(Request $request, PetService $petService)
    {
        $pet = $petService->find($request->route('id'));

        return view('pets.edit', compact('pet'));
    }

    public function update(UpdatePetRequest $request, PetService $petService): RedirectResponse
    {
        $petService->update($request->route('id'), $request->validated());

        return redirect()->route('pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    public function delete(Request $request, PetService $petService): RedirectResponse
    {
        $petService->delete((int)$request->route('id'));

        return redirect()->route('pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}
