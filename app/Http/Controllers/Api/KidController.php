<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\Kid;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class KidController extends Controller
{
    public function index(): array
    {
        return Kid::all()->toArray();
    }

    public function getKidsForAutocomplete(): JsonResponse
    {
        $data = array();
        $kids = Kid::all([
           'id', 'firstname', 'surname', 'lastname', 'birth_date'
        ]);

        foreach($kids as $kid){
            $fullName = $kid['firstname'] . ' ' . $kid['surname']. ' ' . $kid['lastname'];
            $date = Carbon::parse($kid['birth_date']);
            $birth_date = $date->format('d-m-Y');

            $data[] = $kid['id'] . ' ' .$fullName . ' (' . $birth_date . 'г.)';
        }
        return response()->json($data);
    }

    public function store(KidRequest $request): JsonResponse
    {
        $input = $request->all();

        Kid::create($input);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(Kid $kid): JsonResponse
    {
        $kid = $kid->load('kid_services', 'payments', 'equip', 'card');

        return response()->json($kid);
    }

    public function update(KidRequest $request, Kid $kid): JsonResponse
    {
        $input = $request->all();
        $kid->update($input);

        return response()->json(['success'=> 'Успешна редакция на дете']);
    }

    public function destroy(Kid $kid): JsonResponse
    {
        $kid->delete();

        return response()->json(['success' => 'Успешно изтриване на дете']);
    }
}
