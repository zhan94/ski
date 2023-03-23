<?php

namespace App\Repositories\Card;

Interface CardRepositoryInterface
{
    public function allCards();
    public function storeCard($data);
    public function findCard($card);
    public function updateCard($input, $card);
    public function destroyCard($card);
    public function updateCardPrices($input, $card_id);
}
