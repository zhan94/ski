<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServicesData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServicesDataController extends Controller
{

    public function index(): array
    {
        return ServicesData::with('kids')->get()->toArray();
    }

    public function show(ServicesData $data): JsonResponse
    {
        $servicesData = $data->load('service', 'kids.location', 'kids.kidName');

        return response()->json($servicesData);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $dates = json_decode($input['dates']);
        $formatted = array_map(function ($date) {
            return date('d-m-Y', strtotime($date));
        }, $dates);
        $input['dates'] = implode(", ", $formatted);
        ServicesData::create($input);

        return response()->json(['success' => 'Успешно дбавяне на услуга']);
    }
}
