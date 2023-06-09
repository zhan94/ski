<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Repositories\Equip\EquipRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    private EquipRepositoryInterface $equipRepository;
    public function __construct(EquipRepositoryInterface $equipRepository)
    {
        $this->equipRepository = $equipRepository;
    }

    public function index(): array
    {
        return $this->equipRepository->allEquips();
    }

    public function storeEquip(Request $request): JsonResponse
    {
        $this->equipRepository->store($request->all());

        return response()->json(['success' => 'Успешно добавяне на екипировка']);
    }

    public function showEquip(Equip $equip): JsonResponse
    {
        $equip = $equip->load('prices', 'service');
        return response()->json($equip);
    }
    public function updateEquip(Request $request, Equip $equip): JsonResponse
    {
        $this->equipRepository->update($request->all(), $equip);

        return response()->json(['success'=> 'Успешна редакция на екипировка']);
    }

    public function destroyEquip(Equip $equip): JsonResponse
    {
        $this->equipRepository->delete($equip);

        return response()->json(['success' => 'Успешно изтриване на екипировка']);
    }
}
