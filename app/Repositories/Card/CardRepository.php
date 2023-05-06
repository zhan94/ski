<?php

namespace App\Repositories\Card;

use App\Models\Card;
use App\Models\CardPrice;
use Illuminate\Http\JsonResponse;

class CardRepository implements CardRepositoryInterface
{
    public function all(): array
    {
        return Card::with('prices', 'service')->get()->toArray();
    }

    public function store($inputData): void
    {
        $card = Card::create($inputData);
        $card_id = $card->id;
        $this->updateCardPrices($inputData, $card_id);
    }

    public function get($card)
    {
        return $card->load('prices', 'service');
    }

    public function update($inputData, $card): void
    {
        $card_id = $card->id;
        $card->update($inputData);
        $card->prices()->delete();
        $this->updateCardPrices($inputData, $card_id);
    }

    public function delete($card): void
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

        CardPrice::insert($data);
    }
}
