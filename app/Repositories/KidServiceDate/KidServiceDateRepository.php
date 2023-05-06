<?php

namespace App\Repositories\KidServiceDate;

use App\Models\KidService;
use App\Models\KidServiceDate;

class KidServiceDateRepository implements KidServiceDateRepositoryInterface
{
    private KidService $kidService;
    private KidServiceDate $kidServiceDate;

    function __construct(
        KidService                $kidService,
        KidServiceDate            $kidServiceDate
    )
    {
        $this->kidService = $kidService;
        $this->kidServiceDate = $kidServiceDate;
    }

    public function all(): array
    {
        return $this->kidService->all()->toArray();
    }

    public function store($dates, $serviceId): void
    {
        $data = [];
        foreach ($dates as $date) {
            $this->kidServiceDate->create([
                'kid_service_id' => $serviceId,
                'kid_service_date' => $date
            ]);
        }
    }

    public function delete($kidService): void
    {
        $kidService->delete();
    }

    public function getKidServiceDatesByKidAndService($kid, $service): array
    {
        $serviceDates = [];
        $serviceId = $service->id;
        $kidId = $kid->id;
        $getDates = $this->kidService->with('service_dates')
            ->where('service_id', '=', $serviceId)
            ->where('kid_id', '=', $kidId)
            ->get();

        if ($getDates) {
            $serviceDates = $this->getDatesFromResult($getDates);
        }

        return $serviceDates;
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
}
