<?php

namespace App\Repositories\Card;

use App\Models\Card;
use App\Models\CardPrice;
use Illuminate\Http\JsonResponse;

class CardRepository implements CardRepositoryInterface
{
    public function allCards(): array
    {
        return Card::with('prices', 'service')->get()->toArray();
    }

    public function storeCard($input)
    {
        $card = Card::create($input);
        $card_id = $card->id;
        $this->updateCardPrices($input, $card_id);
    }

    public function findCard($card)
    {
        return $card->load('prices', 'service');
    }

    public function updateCard($input, $card)
    {
        $card_id = $card->id;
        $card->update($input);
        $card->prices()->delete();
        $this->updateCardPrices($input, $card_id);
    }

    public function destroyCard($card): JsonResponse
    {
        $card->prices()->delete();
        $card->delete();
    }

    public function updateCardPrices($input, $card_id)
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

        CardPrice::insert($data);
    }
}
