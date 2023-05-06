<?php

namespace App\Repositories\Card;

Interface CardRepositoryInterface
{
    public function all();
    public function store($inputData);
    public function get($card);
    public function update($inputData, $card);
    public function delete($card);
    public function updateCardPrices($input, $card_id);
}
