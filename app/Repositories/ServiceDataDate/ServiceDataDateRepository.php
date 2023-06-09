<?php

namespace App\Repositories\ServiceDataDate;

use App\Models\ServiceDataDate;

class ServiceDataDateRepository implements ServiceDataDateRepositoryInterface
{
    private ServiceDataDate $serviceDataDate;

    function __construct(
        ServiceDataDate $serviceDataDate,
    )
    {
        $this->serviceDataDate = $serviceDataDate;
    }
    public function storeServiceDataDates($serviceDataId, $dates): void
    {
        $dates = json_decode($dates);
        $formatted = array_map(function ($dates) {
            return date('Y-m-d', strtotime($dates));
        }, $dates);
        $data = [];
        foreach ($formatted as $date) {
            $data[] = [
                'service_data_id' => $serviceDataId,
                'service_data_date' => $date
            ];
        }

        $this->serviceDataDate->insert($data);
    }

    public function store($data):void {
        $this->serviceDataDate->insert($data);
    }
}
