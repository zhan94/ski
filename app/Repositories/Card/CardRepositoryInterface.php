<?php

namespace App\Repositories\Card;

Interface CardRepositoryInterface
{
    public function allCards();
    public function storeCard($inputData);
    public function getCard($card);
    public function updateCard($inputData, $card);
    public function deleteCard($card);
    public function updateCardPrices($input, $card_id);
}
