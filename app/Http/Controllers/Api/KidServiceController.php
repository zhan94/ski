<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\KidService;
use Illuminate\Http\JsonResponse;

class KidServiceController extends Controller
{
    public function index(): array
    {
        return KidService::all()->toArray();
    }
    public function store(KidRequest $request): JsonResponse
    {
        $input = $request->all();

        KidService::create($input);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(KidService $kid): JsonResponse
    {
        $kid = $kid->load();

        return response()->json($kid);
    }

    public function update(KidRequest $request, KidService $kid): JsonResponse
    {
        $input = $request->all();
        $kid->update($input);

        return response()->json(['success'=> 'Успешна редакция на дете']);
    }

    public function destroy(KidService $kid): JsonResponse
    {
        $kid->delete();

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }
}
