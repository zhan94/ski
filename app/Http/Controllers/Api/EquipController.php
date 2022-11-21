<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Models\EquipPrice;
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
        $days = json_decode($input['days']);
        $prices = json_decode($input['price']);

        $equip = Equip::create($input);
        $equip_id = $equip->id;

        foreach ($days as $key => $day) {
            $data[] = [
                'equip_id' => $equip_id,
                'days' => $day->value,
                'price' => $prices[$key]->value
            ];
        }

        EquipPrice::insert($data);

        return response()->json(['success' => 'Успешно добавяне на екипировка']);
    }

    public function show(Equip $equip): JsonResponse
    {
        $equip = $equip->load('prices', 'service');
        return response()->json($equip);
    }
    public function update(Request $request, Equip $equip): JsonResponse
    {
        $input = $request->all();

        $days = json_decode($input['day']);
        $prices = json_decode($input['price']);
        $equip_id = $equip->id;

        foreach ($days as $key => $day) {
            $data[] = [
                'equip_id' => $equip_id,
                'days' => $day->value,
                'price' => $prices[$key]->value
            ];
        }

        $equip->update($input);
        $equip->prices()->delete();
        EquipPrice::insert($data);

        return response()->json(['success'=> 'Успешна редакция на екипировка']);
    }

    public function destroy(Equip $equip): JsonResponse
    {
        $equip->prices()->delete();
        $equip->delete();

        return response()->json(['success' => 'Успешно изтриване на екипировка']);
    }
}
