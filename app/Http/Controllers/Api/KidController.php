<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\Kid;
use Illuminate\Http\JsonResponse;

class KidController extends Controller
{
    public function index(): array
    {
        return Kid::all()->toArray();
    }
    public function store(KidRequest $request): JsonResponse
    {
        $input = $request->all();

        Kid::create($input);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(Kid $kid): JsonResponse
    {
        $kid = $kid->load();

        return response()->json($kid);
    }

    public function update(KidRequest $request, Kid $kid): JsonResponse
    {
        $input = $request->all();
        $kid->update($input);

        return response()->json(['success'=> 'Успешна редакция на дете']);
    }

    public function destroy(Kid $kid): JsonResponse
    {
        $kid->delete();

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }
}
