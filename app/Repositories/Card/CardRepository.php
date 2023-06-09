<?php

namespace App\Repositories\Card;

use App\Models\Card;
use App\Models\CardPrice;

class CardRepository implements CardRepositoryInterface
{
    private Card $card;
    private CardPrice $cardPrice;

    public function __construct(
        Card $card,
        CardPrice $cardPrice
    )
    {
        $this->card = $card;
        $this->cardPrice = $cardPrice;
    }

    public function allCards(): array
    {
        return $this->card->with('prices', 'service')->get()->toArray();
    }

    public function storeCard($inputData): void
    {
        $card = $this->card->create($inputData);
        $card_id = $card->id;
        $this->updateCardPrices($inputData, $card_id);
    }

    public function getCard($card)
    {
        return $card->load('prices', 'service');
    }

    public function updateCard($inputData, $card): void
    {
        $card_id = $card->id;
        $card->update($inputData);
        $card->prices()->delete();
        $this->updateCardPrices($inputData, $card_id);
    }

    public function deleteCard($card): void
    {
        $card->prices()->delete();
        $card->delete();
    }

    public function updateCardPrices($input, $card_id): void
    {
        $items = json_decode($input['items']);
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'card_id' => $card_id,
                'days' => $item->days,
                'price' => $item->prices
            ];
        }

        $this->cardPrice->insert($data);
    }
}
