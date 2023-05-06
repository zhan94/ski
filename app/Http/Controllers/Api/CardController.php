<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Card\CardRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Http\JsonResponse;

class CardController extends Controller
{
    private CardRepositoryInterface $cardRepository;

    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }
    public function index(): array
    {
        return $this->cardRepository->all();
    }

    public function store(Request $request): JsonResponse
    {
        $this->cardRepository->store($request->all());

        return response()->json(['success' => 'Успешно добавяне на карта']);
    }

    public function show(Card $card): JsonResponse
    {
        $card = $this->cardRepository->get($card);

        return response()->json($card);
    }
    public function update(Request $request, Card $card): JsonResponse
    {
        $this->cardRepository->update($request->all(), $card);

        return response()->json(['success'=> 'Успешна редакция на карта']);
    }

    public function destroy(Card $card): JsonResponse
    {
        $this->cardRepository->delete($card);

        return response()->json(['success' => 'Успешно изтриване на карта']);
    }
}
