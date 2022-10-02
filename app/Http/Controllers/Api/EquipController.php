<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Models\EquipPrice;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    public function index(): array
    {
        return Equip::with('prices', 'service')->get()->toArray();
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $equip = Equip::create($input);
        $equip_id = $equip->id;

        foreach ($request->prices as $price) {
            $prices[] = [
                'price' => $price->price,
                'days' => $price->days,
                'equip_id' => $equip_id
            ];
        }
        EquipPrice::create($prices);

        return response()->json(['success' => 'Успешно дбавяне на екипировка']);
    }

    public function show(Equip $equip)
    {
        //
    }

    public function edit(Equip $equip)
    {
        //
    }

    public function update(Request $request, Equip $equip)
    {
        //
    }

    public function destroy(Equip $equip): JsonResponse
    {
        $equip->delete();

        return response()->json(['success' => 'Успешно изтриване на екипировка']);
    }
}
