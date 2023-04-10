<?php

namespace App\Repositories\ServiceData;

use App\Models\ServicesData;
use Illuminate\Support\Facades\DB;

class ServiceDataRepository implements ServiceDataRepositoryInterface
{

    public function allServiceData(): array
    {
        return ServicesData::with(['kids', 'dates'])->get()->toArray();
    }

    public function storeServiceData($inputData): void
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
        return $serviceData->load('service', 'kids.location', 'kids.kidName', 'kids.service_dates', 'dates');
    }

    public function checkIfDataIsAdded($inputData)
    {
        DB::enableQueryLog();
        $dates = json_decode($inputData['dates']);
        $serviceId = $inputData['service_id'];

        $format = collect($dates)->map(function ($item) {
            return date('d-m-Y', strtotime($item));
        })->all();

        $data = ServicesData::with(['service'])
            ->whereIn('dates', ['26-04-2023', '27-04-2023'])
            ->where('service_id', $serviceId)
        ->get();

        $query = DB::getQueryLog();
        dd($query);

    }
}
