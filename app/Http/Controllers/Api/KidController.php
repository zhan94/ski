<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\AdditionalService;
use App\Models\Kid;
use App\Models\Service;
use App\Models\ServiceType;
use App\Repositories\Kid\KidRepository;
use App\Repositories\Kid\KidRepositoryInterface;
use Illuminate\Http\JsonResponse;

class KidController extends Controller
{

    private KidRepositoryInterface $kidRepository;

    public function __construct(KidRepositoryInterface $kidRepository)
    {
    $this->kidRepository = $kidRepository;}

    public function index(): array
    {
        return $this->kidRepository->allKids();
    }

    public function create(): JsonResponse
    {
        $data = $this->kidRepository->createKid();

        return response()->json($data);
    }

    public function store(KidRequest $request): JsonResponse
    {
        $inputData = $request->all();
        $this->kidRepository->storeKid($inputData);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(Kid $kid): JsonResponse
    {
        $kid = $this->kidRepository->findKid($kid);

        return response()->json($kid);
    }

    public function update(KidRequest $request, Kid $kid): JsonResponse
    {
        $inputData = $request->all();
        $this->kidRepository->updateKid($inputData, $kid);

        return response()->json(['success'=> 'Успешна редакция на дете']);
    }

    public function destroy(Kid $kid): JsonResponse
    {
        $this->kidRepository->destroyKid($kid);

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }

    public function search(Kid $kid, ServiceType $serviceType): JsonResponse
    {
        $data = $this->kidRepository->search($kid, $serviceType);

        return response()->json($data);
    }
}
