<?php

namespace App\Repositories\ReportRepository;

use App\Models\KidService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReportRepository implements ReportRepositoryInterface
{
    private KidService $kidService;

    function __construct(KidService $kidService)
    {
        $this->kidService = $kidService;
    }
    public function get($service, $dateFrom, $dateTo): array
    {
        if ($dateFrom === 'undefined' || $dateTo === 'undefined') {
            return ['error' => 'Моля въведете дата!'];
        }

        $serviceId = $service->id;
        $dateFromFormatted = (array)Carbon::createFromFormat('D M d Y H:i:s e+', $dateFrom);
        $dateToFormatted = (array)Carbon::createFromFormat('D M d Y H:i:s e+', $dateTo);
        $dateFrom = date('d-m-Y', strtotime($dateFromFormatted['date']));
        $dateTo = date('d-m-Y', strtotime($dateToFormatted['date']));

        $period = CarbonPeriod::create($dateFrom, $dateTo);
        $report = [];
        $report['data'] = $this->getDataForReport($serviceId, $period);;
        $report['service_name'] = $service->name;
        $report['date_from'] = $dateFrom;
        $report['date_to'] = $dateTo;

        return $report;
    }

    private function getDataForReport($serviceId, $period): array
    {
        $loadRelations = ['kid', 'location', 'skill', 'equip', 'card'];
        $data = [];

        foreach ($period as $date) {
            $kidService = $this->kidService->with($loadRelations)
                ->join('kid_service_dates', 'kid_service_dates.kid_service_id', '=', 'kid_services.id')
                ->where('service_id', '=', $serviceId)
                ->where('kid_service_dates.kid_service_date', '=', $date)
                ->get()
                ->toArray();

            if (!empty($kidService)) {
                foreach ($kidService as $service) {
                    $data['kid_id'] = $service;
                }
            }
        }
        return $data;
    }
}
