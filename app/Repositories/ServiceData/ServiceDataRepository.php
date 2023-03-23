<?php

namespace App\Repositories\ServiceData;

use App\Models\ServicesData;

class ServiceDataRepository implements ServiceDataRepositoryInterface
{

    public function allServiceData(): array
    {
        return ServicesData::with('kids')->get()->toArray();
    }

    public function storeServiceData($inputData)
    {
        $dates = json_decode($inputData['dates']);
        $formatted = array_map(function ($date) {
            return date('d-m-Y', strtotime($date));
        }, $dates);
        $inputData['dates'] = implode(", ", $formatted);
        ServicesData::create($inputData);
    }

    public function findServiceData($serviceData): ServicesData
    {
        return $serviceData->load('service', 'kids.location', 'kids.kidName');
    }
}
