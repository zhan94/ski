<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{

    public function index(): array
    {
        return Service::with('locations')->get()->toArray();
    }

    public function store(StoreLocationRequest $request): JsonResponse
    {
        $input = $request->all();
        Location::create($input);

        return response()->json(['success' => 'Успешно дбавяне на местоположение']);
    }

    public function show(Location $location): JsonResponse
    {
        $location = $location->load('service');

        return response()->json($location);
    }

    public function update(UpdateLocationRequest $request, Location $location): JsonResponse
    {
        $input = $request->all();
        $location->update($input);

        return response()->json(['success'=> 'Успешна редакция на местоположение']);
    }

    public function destroy(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json(['success' => 'Успешно изтриване на местоположение']);
    }
}
