<?php

namespace App\Repositories\KidService;

use App\Models\KidService;

class KidServiceRepository implements KidServiceRepositoryInterface
{

    private KidService $kidService;

    function __construct(KidService $kidService)
    {
        $this->kidService = $kidService;
    }

    public function all(): array
    {
        return $this->kidService->all()->toArray();
    }

    public function store($inputData)
    {
        return $this->kidService->create($inputData);
    }

    public function get($kidService): array
    {
        return $kidService->load();
    }

    public function update($inputData, $kidService): void
    {
        $kidService->update($inputData);
    }

    public function delete($kidService): void
    {
        $kidService->delete();
    }

    public function getByKidAndService($kid, $service): array|null
    {
        $serviceId = $service->id;
        $kidId = $kid->id;
        $getDates = $this->kidService->with('service_dates')
            ->where('service_id', '=', $serviceId)
            ->where('kid_id', '=', $kidId)
            ->get();

        if ($getDates) {
            return $this->getDatesFromResult($getDates);
        }

        return null;
    }

    private function getDatesFromResult($serviceDates): array
    {
        $dates = [];
        if (!empty($serviceDates)) {
            foreach ($serviceDates as $serviceDate) {
                foreach ($serviceDate->service_dates as $dd) {
                    $date = preg_replace('/-/', ',', $dd['kid_service_date']);
                    if ($date !== '') {
                        $dates[] = $date;
                    }
                }
            }
        }
        return $dates;
    }

    public function getIdByKidAndDate($kidId, $serviceDataId)
    {
        $serviceId = 0;
        $sql = $this->kidService->select('service_id')
            ->where('kid_id', '=', $kidId)
            ->where('services_data_id', '=', $serviceDataId)
            ->first();

        if ($sql) {
            $serviceId = $sql->service_id;
        }
        return $serviceId;
    }
}
