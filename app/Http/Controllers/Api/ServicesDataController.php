<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServicesData;
use Illuminate\Http\JsonResponse;

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
}
