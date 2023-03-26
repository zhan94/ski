<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Repositories\AdditionalService\AdditionalServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    private AdditionalServiceRepositoryInterface $additionalServiceRepository;

    public function __construct(AdditionalServiceRepositoryInterface $additionalServiceRepository)
    {
        $this->additionalServiceRepository = $additionalServiceRepository;
    }

    public function index(): JsonResponse
    {
        $services = AdditionalService::with('prices')->get();

        return response()->json($services);
    }

    public function store(Request $request): JsonResponse
    {
        $this->additionalServiceRepository->storeAdditionalService($request->all());

        return response()->json(['success' => 'Успешно добавяне на допълнителни занятия']);
    }

    public function show(AdditionalService $additionalService): JsonResponse
    {
        $additionalService = $additionalService->load('prices');

        return response()->json($additionalService);
    }

    public function update(Request $request, AdditionalService $additionalService): JsonResponse
    {
        $inputData = $request->all();
        $this->additionalServiceRepository->updateAdditionalService($inputData, $additionalService);

        return response()->json(['success' => 'Успешна редакция на занятие']);
    }

    public function destroy(AdditionalService $additionalService): JsonResponse
    {
        $this->additionalServiceRepository->destroyAdditionalService($additionalService);

        return response()->json(['success' => 'Успешно изтриване на занятие']);
    }
}
