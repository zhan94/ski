<?php

namespace App\Repositories\KidService;

use App\Models\KidService;
use App\Models\Service;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;

class KidServiceRepository implements KidServiceRepositoryInterface
{
    public function allKidServices(): array
    {
        return KidService::all()->toArray();
    }

    public function storeKidService($inputData): void
    {
        KidService::create($inputData);
    }

    public function findKidService($kidService): array
    {
        return $kidService->load();
    }

    public function updateKidService($inputData, $kidService): bool
    {
        $kidService->update($inputData);
    }

    public function destroyKidService($kidService): bool
    {
        $kidService->delete();
    }

    public function drawReport($service, $date_from, $date_to): array
    {
        if ($date_from === 'undefined' || $date_to === 'undefined') {
            return response()->json(['error' => 'Моля въведете дата!']);
        }
        $service_id = $service->id;

        $loadRelations = ['kid', 'location', 'skill', 'equip', 'card'];
        $dateFromFormatted = (array)Carbon::createFromFormat('D M d Y H:i:s e+', $date_from);
        $dateToFormatted = (array)Carbon::createFromFormat('D M d Y H:i:s e+', $date_to);
        $dateFrom = date('d-m-Y', strtotime($dateFromFormatted['date']));
        $dateTo = date('d-m-Y', strtotime($dateToFormatted['date']));

        $period = CarbonPeriod::create($dateFrom, $dateTo);
        $report = [];
        foreach ($period as $date) {
            $formattedDate = $date->format('d.m.Y');
            $collection = KidService::with($loadRelations)
                ->where('dates', 'LIKE', '%' . $formattedDate . '%')
                ->where('service_id', '=', $service_id)
                ->get();
            if (!$collection->isEmpty()) {
                $report['data'] = $collection;
            }
        }
        $report['service_name'] = $service->name;
        $report['date_from'] = $dateFrom;
        $report['date_to'] = $dateTo;

        return $report;
    }
}