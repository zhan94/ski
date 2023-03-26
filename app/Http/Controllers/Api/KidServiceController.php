<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\KidService;
use App\Models\Service;
use App\Repositories\KidService\KidServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class KidServiceController extends Controller
{

    private KidServiceRepositoryInterface $kidServiceRepository;

    public function __construct(KidServiceRepositoryInterface $kidServiceRepository)
    {
        $this->kidServiceRepository = $kidServiceRepository;
    }

    public function index(): array
    {
        return $this->kidServiceRepository->allKidServices();
    }

    public function store(Request $request): JsonResponse
    {
        #TODO fetch service data dates
        $inputData = $request->all();
        $this->kidServiceRepository->storeKidService($inputData);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(KidService $kid): JsonResponse
    {
        $kid = $this->kidServiceRepository->findKidService($kid);

        return response()->json($kid);
    }

    public function update(KidRequest $request, KidService $kid): JsonResponse
    {
        $inputData = $request->all();
        $this->kidServiceRepository->updateKidService($inputData, $kid);

        return response()->json(['success' => 'Успешна редакция на дете']);
    }

    public function destroy(KidService $kid): JsonResponse
    {
        $this->kidServiceRepository->destroyKidService($kid);

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }

    public function report(Service $service, $date_from, $date_to): JsonResponse
    {
        $report = $this->kidServiceRepository->drawReport($service, $date_from, $date_to);

        return response()->json($report);
    }
}
