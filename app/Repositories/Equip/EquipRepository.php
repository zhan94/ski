<?php

namespace App\Repositories\Equip;

use App\Models\Equip;
use App\Models\EquipPrice;

/**
 * Class EquipRepository.
 */
class EquipRepository implements EquipRepositoryInterface
{
    private Equip $equip;
    private EquipPrice $equipPrice;

    public function __construct(
        Equip $equip,
        EquipPrice $equipPrice,
    ) {
        $this->equip = $equip;
        $this->equipPrice = $equipPrice;
    }

    public function allEquips(): array
    {
        return $this->equip->with('prices', 'service')->get()->toArray();
    }

    public function storeEquip($data): void
    {
        $equip = $this->equip->create($data);
        $equip_id = $equip->id;
        $this->updateEquipPrices($data, $equip_id);
    }

    public function getEquip($equip)
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

    public function deleteEquip($equip): void
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
        $this->equipPrice->insert($data);
    }
}
