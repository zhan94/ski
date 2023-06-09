<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\Kid;
use App\Models\KidService;
use App\Models\Service;
use App\Repositories\KidService\KidServiceRepositoryInterface;
use App\Repositories\ReportRepository\ReportRepositoryInterface;
use App\Repositories\ServiceData\ServiceDataRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KidServiceController extends Controller
{
    private KidServiceRepositoryInterface $kidServiceRepository;
    private ServiceDataRepositoryInterface $serviceData;
    private ReportRepositoryInterface $reportRepository;

    public function __construct(
        KidServiceRepositoryInterface $kidServiceRepository,
        ServiceDataRepositoryInterface $serviceData,
        ReportRepositoryInterface $reportRepository
    )
    {
        $this->kidServiceRepository = $kidServiceRepository;
        $this->serviceData = $serviceData;
        $this->reportRepository = $reportRepository;
    }

    public function index(): array
    {
        return $this->kidServiceRepository->allKidServices();
    }

    public function store(Request $request): JsonResponse
    {
        $inputData = $request->all();
        $this->serviceData->addServiceData($inputData);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(KidService $kid): JsonResponse
    {
        $kid = $this->kidServiceRepository->getKidService($kid);

        return response()->json($kid);
    }

    public function update(KidRequest $request, KidService $kid): JsonResponse
    {
        $inputData = $request->all();
        $this->kidServiceRepository->updateKidService($inputData, $kid);

        return response()->json(['success' => 'Успешна редакция на дете']);
    }

    public function destroy(KidService $kidService): JsonResponse
    {
        $this->kidServiceRepository->deleteKidService($kidService);

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }

    public function report(Service $service, $date_from, $date_to): JsonResponse
    {
        $report = $this->reportRepository->get($service, $date_from, $date_to);

        return response()->json($report);
    }

    public function getByKidAndService(Kid $kid, Service $service): JsonResponse
    {
        $dates = $this->kidServiceRepository->getByKidAndService($kid, $service);

        return response()->json($dates);
    }
}
