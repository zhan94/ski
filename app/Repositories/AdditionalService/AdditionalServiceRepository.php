<?php

namespace App\Repositories\AdditionalService;

use App\Models\AdditionalService;
use App\Models\AdditionalServicePrice;

class AdditionalServiceRepository implements AdditionalServiceRepositoryInterface
{

    public function all(): array
    {
        return AdditionalService::with('prices')->get()->toArray();
    }

    public function get($additionalService)
    {
        $additionalService->load('prices');
    }

    public function store($inputData): void
    {
        $data = [];

        $items = json_decode($inputData['items']);

        $service = AdditionalService::create($inputData);
        $service_id = $service->id;

        foreach ($items as $item) {
            $data[] = [
                'service_id' => $service_id,
                'day' => $item->days,
                'price' => $item->prices
            ];
        }

        AdditionalServicePrice::insert($data);
    }

    public function update($inputData, $additionalService)
    {
        $items = json_decode($inputData['items']);
        $serviceId = $additionalService->id;
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'service_id' => $serviceId,
                'day' => $item->days,
                'price' => $item->prices
            ];
        }

        $additionalService->update($inputData);
        AdditionalServicePrice::insert($data);
    }

    public function delete($additionalService): void
    {
        $additionalService->prices()->delete();
        $additionalService->delete();
    }
}
