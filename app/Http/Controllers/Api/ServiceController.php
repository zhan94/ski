<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{

    private ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(): array
    {
        return $this->serviceRepository->allServices();
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        $inputData = $request->all();
        $this->serviceRepository->storeService($inputData);

        return response()->json(['success' => 'Успешно дбавяне на услуга']);
    }

    public function update(ServiceRequest $request, Service $service): JsonResponse
    {
        $inputData = $request->all();
        $this->serviceRepository->updateService($inputData, $service);

        return response()->json(['success' => 'Успешна редакция на услуга']);
    }

    public function destroy(Service $service): JsonResponse
    {
        $this->serviceRepository->destroyService($service);

        return response()->json(['success' => 'Успешно изтриване на услуга']);
    }

    public function getLocations(Service $service): JsonResponse
    {
        $locations = $this->serviceRepository->findLocationsByService($service);

        return response()->json($locations);
    }
}
