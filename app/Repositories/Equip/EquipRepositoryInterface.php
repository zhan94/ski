<?php

namespace App\Repositories\Equip;

Interface EquipRepositoryInterface
{
    public function allEquips();
    public function storeEquip($data);
    public function getEquip($equip);
    public function updateEquip($input, $equip);
    public function deleteEquip($equip);
    public function updateEquipPrices($input, $equip_id);
}
