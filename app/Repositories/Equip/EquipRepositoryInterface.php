<?php

namespace App\Repositories\Equip;

Interface EquipRepositoryInterface
{
    public function allEquips();
    public function storeEquip($data);
    public function findEquip($equip);
    public function updateEquip($input, $equip);
    public function destroyEquip($equip);
    public function updateEquipPrices($input, $equip_id);
}
