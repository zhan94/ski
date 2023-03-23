<?php

namespace App\Repositories\Location;

use App\Models\Location;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use App\Repositories\Location\LocationRepositoryInterface as LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    public function allLocations(): array
    {
        return Service::with('locations')->get()->toArray();
    }

    public function storeLocation($inputData)
    {
        return Location::create($inputData);
    }

    public function findLocation($location)
    {
        return $location->load('service');
    }

    public function updateLocation($inputData, $location): void
    {
        $location->update($inputData);
    }

    public function destroyLocation($location): bool
    {
        return $location->delete();
    }
}
