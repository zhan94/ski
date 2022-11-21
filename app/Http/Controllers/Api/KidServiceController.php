<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\KidService;
use App\Models\Service;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;


class KidServiceController extends Controller
{
    public function index(): array
    {
        return KidService::all()->toArray();
    }

    public function store(KidRequest $request): JsonResponse
    {
        $input = $request->all();

        KidService::create($input);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(KidService $kid): JsonResponse
    {
        $kid = $kid->load();

        return response()->json($kid);
    }

    public function update(KidRequest $request, KidService $kid): JsonResponse
    {
        $input = $request->all();
        $kid->update($input);

        return response()->json(['success' => 'Успешна редакция на дете']);
    }

    public function destroy(KidService $kid): JsonResponse
    {
        $kid->delete();

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }

    public function report(Service $service, $date_from, $date_to): JsonResponse
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

        return response()->json($report);
    }
}
