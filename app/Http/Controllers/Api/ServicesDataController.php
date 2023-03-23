<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServicesData;
use App\Repositories\ServiceData\ServiceDataRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServicesDataController extends Controller
{
    private ServiceDataRepositoryInterface $serviceRepository;

    public function __construct(ServiceDataRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(): array
    {
        return $this->serviceRepository->allServiceData();
    }

    public function show(ServicesData $data): JsonResponse
    {
        $servicesData = $this->serviceRepository->findServiceData($data);

        return response()->json($servicesData);
    }

    public function store(Request $request): JsonResponse
    {
        $this->serviceRepository->storeServiceData($request->all());

        return response()->json(['success' => 'Успешно дбавяне на услуга']);
    }
}
