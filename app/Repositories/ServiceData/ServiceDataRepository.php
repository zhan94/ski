<?php

namespace App\Repositories\ServiceData;

use App\Repositories\KidService\KidServiceRepository;
use App\Models\ServicesData;
use App\Repositories\KidServiceDate\KidServiceDateRepository;
use App\Repositories\ServiceDataDate\ServiceDataDateRepository;

class ServiceDataRepository implements ServiceDataRepositoryInterface
{
    private ServicesData $serviceData;
    private ServiceDataDateRepository $serviceDataDate;
    private KidServiceRepository $kidService;
    private KidServiceDateRepository $kidServiceDate;
    private int $max = 25;

    function __construct(
        ServicesData              $serviceData,
        ServiceDataDateRepository $serviceDataDate,
        KidServiceRepository      $kidService,
        KidServiceDateRepository  $kidServiceDate,
    )
    {
        $this->serviceData = $serviceData;
        $this->serviceDataDate = $serviceDataDate;
        $this->kidService = $kidService;
        $this->kidServiceDate = $kidServiceDate;
    }

    public function all(): array
    {
        return $this->serviceData->with(['kids'])->get()->toArray();
    }

    public function store($serviceId, $max): ServicesData
    {
        return $this->serviceData
            ->create(
                [
                    'service_id' => $serviceId,
                    'max' => $max
                ]
            );
    }

    public function get($serviceData): ServicesData
    {
        return $serviceData->load('service', 'kids.location', 'kids.kidName', 'kids.service_dates');
    }

    public function addServiceData($inputData): void
    {
        $dates = json_decode($inputData['dates']);
        unset($inputData['dates']);
        $serviceId = $inputData['service_id'];
        $inputData['card_id'] = null;
        $inputData['equip_id'] = null;
        $inputData['skill_id'] = null;
        $formatted = array_map(function ($dates) {
            return date('Y-m-d', strtotime($dates));
        }, $dates);
        $newDates = [];
        $oldDates = [];
        foreach ($formatted as $date) {
            $serviceDataDates = $this->getDataDateIdByServiceIdAndDate($serviceId, $date);
            if (!empty($serviceDataDates)) {
                $serviceDataId = (int)$serviceDataDates['service_data_id'];
                $serviceDateDate = $serviceDataDates['service_data_date'];
                if ($serviceDateDate === $date) {
                    $oldDates[] = [
                        'services_data_id' => $serviceDataId,
                        'service_data_date' => $serviceDateDate
                    ];
                }
            } else {
                $newDates[] = $date;
            }
        }
        if (!empty($newDates)) {
            $serviceDataId = $this->storeNewDates($serviceId, $newDates);
            $inputData['services_data_id'] = $serviceDataId;
            $kidService = $this->kidService->store($inputData);
            $this->kidServiceDate->store($newDates, $kidService->id);
        }
        if (!empty($oldDates)) {
            $oldDatesDates = [];
            $serviceDataIds = [];
            foreach ($oldDates as $date) {
                $oldDatesDates[] = $date['service_data_date'];
                $serviceDataIds[] = $date['services_data_id'];
            }
            $serviceDataIds = array_unique($serviceDataIds);
            foreach ($serviceDataIds as $serviceDataId) {
                $inputData['services_data_id'] = $serviceDataId;
                $kidService = $this->kidService->store($inputData);
                $this->kidServiceDate->store($oldDatesDates, $kidService->id);
            }
        }
    }

    public function getDataDateIdByServiceIdAndDate($serviceId, $date): array
    {
        $serviceData = $this->serviceData->select('service_data_id', 'service_data_date')
            ->join('service_data_dates', 'service_data_dates.service_data_id', '=', 'services_data.id')
            ->where('service_id', '=', $serviceId)
            ->where('service_data_dates.service_data_date', '=', $date)
            ->first();
        if ($serviceData) {
            $serviceData = $serviceData->toArray();
        } else {
            $serviceData = [];
        }
        return $serviceData;
    }

    private function storeNewDates($serviceId, $dates): int
    {
        $serviceData = $this->serviceData->create(
            [
                'service_id' => $serviceId,
                'max' => $this->max
            ]
        );
        $serviceDataId = (int)$serviceData->id;
        foreach ($dates as $date) {
            $this->serviceDataDate->store([
                'service_data_id' => $serviceDataId,
                'service_data_date' => $date
            ]);
        }
        return $serviceDataId;
    }
}
