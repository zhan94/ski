<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Models\Skill;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function all(): array
    {
        return Service::with(['data.kids_count','data','data.data_dates'])
            ->get()
            ->toArray();
    }

    public function store($inputData): void
    {
        Service::create($inputData);
    }

    public function update($inputData, $service): void
    {
        $service->update($inputData);
    }

    public function delete($service): void
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
