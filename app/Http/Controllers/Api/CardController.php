<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\CardPrice;
use Illuminate\Http\JsonResponse;

class CardController extends Controller
{
    public function index(): array
    {
        return Card::with('prices', 'service')->get()->toArray();
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $items = json_decode($input['items']);

        $equip = Card::create($input);
        $card_id = $equip->id;

        foreach ($items as $key => $item) {
            $data[] = [
                'card_id' => $card_id,
                'days' => $item->days,
                'price' => $item->prices
            ];
        }

        CardPrice::insert($data);

        return response()->json(['success' => 'Успешно добавяне на карта']);
    }

    public function show(Card $card): JsonResponse
    {
        $card = $card->load('prices', 'service');
        return response()->json($card);
    }
    public function update(Request $request, Card $card): JsonResponse
    {
        $input = $request->all();

        $items = json_decode($input['items']);
        $card_id = $card->id;

        foreach ($items as $key => $item) {
            $data[] = [
                'card_id' => $card_id,
                'days' => $item->days,
                'price' => $item->prices
            ];
        }

        $card->update($input);
        $card->prices()->delete();
        CardPrice::insert($data);

        return response()->json(['success'=> 'Успешна редакция на карта']);
    }

    public function destroy(Card $card): JsonResponse
    {
        $card->prices()->delete();
        $card->delete();

        return response()->json(['success' => 'Успешно изтриване на карта']);
    }
}
