<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): array
    {
        return Service::with('data.kids_count')->get()->toArray();
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        $input = $request->all();
        Service::create($input);

        return response()->json(['success' => 'Успешно дбавяне на услуга']);
    }

    public function update(ServiceRequest $request, Service $service): JsonResponse
    {
        $input = $request->all();
        $service->update($input);

        return response()->json(['success' => 'Успешна редакция на услуга']);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json(['success' => 'Успешно изтриване на услуга']);
    }

    public function getLocations(Service $service): JsonResponse
    {
        $locations = $service->load('locations');

        return response()->json($locations->locations);
    }
}
