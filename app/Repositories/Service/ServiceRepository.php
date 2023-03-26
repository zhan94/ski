<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Models\Skill;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function allServices(): array
    {
        return Service::with('data.kids_count')->get()->toArray();
    }

    public function storeService($inputData)
    {
        Service::create($inputData);
    }

    public function updateService($inputData, $service)
    {
        $service->update($inputData);
    }

    public function destroyService($service)
    {
        $service->delete();
    }

    public function findLocationsByService($service)
    {
        $locations = $service->load('locations');
        return $locations->locations;
    }

    public function allSkills(): array
    {
        return Skill::all()->toArray();
    }
}
