<?php

namespace App\Repositories\Location;

use App\Models\Location;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use App\Repositories\Location\LocationRepositoryInterface as LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    public function all(): array
    {
        return Service::with('locations')->get()->toArray();
    }

    public function store($inputData)
    {
        return Location::create($inputData);
    }

    public function get($location)
    {
        return $location->load('service');
    }

    public function update($inputData, $location): void
    {
        $location->update($inputData);
    }

    public function delete($location): bool
    {
        return $location->delete();
    }
}
