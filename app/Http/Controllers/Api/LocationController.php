<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Repositories\Location\LocationRepositoryInterface;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    private LocationRepositoryInterface $locationRepository;
    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function index(): array
    {
        return $this->locationRepository->all();
    }

    public function store(StoreLocationRequest $request): JsonResponse
    {
        $inputData = $request->all();
        $this->locationRepository->store($inputData);

        return response()->json(['success' => 'Успешно дбавяне на местоположение']);
    }

    public function show(Location $location): JsonResponse
    {
        $location = $this->locationRepository->get($location);

        return response()->json($location);
    }

    public function update(UpdateLocationRequest $request, Location $location): JsonResponse
    {
        $inputData = $request->all();
        $this->locationRepository->update($inputData, $location);

        return response()->json(['success'=> 'Успешна редакция на местоположение']);
    }

    public function destroy(Location $location): JsonResponse
    {
        $this->locationRepository->delete($location);

        return response()->json(['success' => 'Успешно изтриване на местоположение']);
    }

}
