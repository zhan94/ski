<?php

namespace App\Repositories\Equip;

use App\Models\Equip;
use App\Models\EquipPrice;
use Illuminate\Http\JsonResponse;

/**
 * Class EquipRepository.
 */
class EquipRepository implements EquipRepositoryInterface
{
    public function allEquips(): array
    {
        return Equip::with('prices', 'service')->get()->toArray();
    }

    public function storeEquip($input): void
    {
        $equip = Equip::create($input);
        $equip_id = $equip->id;
        $this->updateEquipPrices($input, $equip_id);
    }

    public function findEquip($equip)
    {
        return $equip->load('prices', 'service');
    }

    public function updateEquip($input, $equip): void
    {
        $equip_id = $equip->id;
        $equip->update($input);
        $equip->prices()->delete();
        $this->updateEquipPrices($input, $equip_id);
    }

    public function destroyEquip($equip): void
    {
        $equip->prices()->delete();
        $equip->delete();
    }

    public function updateEquipPrices($input, $equip_id): void
    {
        $items = json_decode($input['items']);
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'equip_id' => $equip_id,
                'days' => $item->days,
                'price' => $item->prices
            ];
        }

        EquipPrice::insert($data);
    }
}
