<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\AdditionalServicePrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = AdditionalService::with('prices')->get();

        return response()->json($services);
    }

    public function store(Request $request): JsonResponse
    {
        $data = [];
        $input = $request->all();
        $items = json_decode($input['items']);

        $service = AdditionalService::create($input);
        $service_id = $service->id;

        foreach ($items as $item) {
            $data[] = [
                'service_id' => $service_id,
                'day' => $item->days,
                'price' => $item->prices
            ];
        }

        AdditionalServicePrice::insert($data);

        return response()->json(['success' => 'Успешно добавяне на допълнителни занятия']);
    }

    public function show(AdditionalService $additionalService): JsonResponse
    {
        $additionalService = $additionalService->load('prices');
        return response()->json($additionalService);
    }

    public function update(Request $request, AdditionalService $additional_service): JsonResponse
    {
        $input = $request->all();
        $items = json_decode($input['items']);
        $service_id = $additional_service->id;
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'service_id' => $service_id,
                'day' => $item->days,
                'price' => $item->prices
            ];
        }

        $additional_service->update($input);
        AdditionalServicePrice::insert($data);

        return response()->json(['success' => 'Успешна редакция на занятие']);
    }

    public function destroy(AdditionalService $additionalService): JsonResponse
    {
        $additionalService->prices()->delete();
        $additionalService->delete();

        return response()->json(['success' => 'Успешно изтриване на занятие']);
    }
}
