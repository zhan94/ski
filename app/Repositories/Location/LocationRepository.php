<?php

namespace App\Repositories\Location;

use App\Models\Location;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use App\Repositories\Location\LocationRepositoryInterface as LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    private Location $location;
    public function __construct(
        Location $location,
    ) {
        $this->location = $location;
    }

    public function allLocations(): array
    {
        return Service::with('locations')->get()->toArray();
    }

    public function storeLocation($inputData)
    {
        return $this->location->create($inputData);
    }

    public function getLocation($location)
    {
        return $location->load('service');
    }

    public function updateLocation($inputData, $location): void
    {
        $location->update($inputData);
    }

    public function deleteLocation($location): bool
    {
        return $location->delete();
    }
}
