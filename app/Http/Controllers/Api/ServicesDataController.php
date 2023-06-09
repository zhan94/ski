<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServicesData;
use App\Repositories\ServiceData\ServiceDataRepositoryInterface;
use App\Repositories\ServiceDataDate\ServiceDataDateRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServicesDataController extends Controller
{
    private ServiceDataRepositoryInterface $serviceRepository;
    private ServiceDataDateRepositoryInterface $serviceDatesRepository;

    public function __construct(
        ServiceDataRepositoryInterface $serviceRepository,
        ServiceDataDateRepositoryInterface $serviceDatesRepository
    )
    {
        $this->serviceRepository = $serviceRepository;
        $this->serviceDatesRepository = $serviceDatesRepository;
    }

    public function index(): array
    {
        return $this->serviceRepository->allData();
    }

    public function show(ServicesData $data): JsonResponse
    {
        $servicesData = $this->serviceRepository->getData($data);
        return response()->json($servicesData);
    }

    public function store(Request $request): JsonResponse
    {
        $inputData = $request->all();
        $serviceId = $inputData['service_id'];
        $max = $inputData['max'];
        $dates = $inputData['dates'];

        $servicesData = $this->serviceRepository->storeData($serviceId, $max);
        $this->serviceDatesRepository->storeServiceDataDates($servicesData->id, $dates);

        return response()->json(['success' => 'Успешно дбавяне на услуга']);
    }
}
