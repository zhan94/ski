<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KidRequest;
use App\Models\AdditionalService;
use App\Models\Kid;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\JsonResponse;

class KidController extends Controller
{

    public function index(): array
    {
        return Kid::all()->toArray();
    }

    public function create(): JsonResponse
    {
        $service_types = ServiceType::all();
        $kids_data = array();
        $data = array();
        $kids = Kid::all([
           'id', 'firstname', 'surname', 'lastname', 'birth_date'
        ]);

        foreach($kids as $kid){
            $fullName = $kid['firstname'] . ' ' . $kid['surname']. ' ' . $kid['lastname'];
            $kids_data[] = $kid['id'] . ' ' .$fullName . ' (' . $kid['birth_date'] . 'г.)';
        }

        $data['kids'] = $kids_data;
        $data['service_types'] = $service_types;

        return response()->json($data);
    }

    public function store(KidRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['birth_date'] = date('d-m-Y', strtotime($input['birth_date']));

        Kid::create($input);

        return response()->json(['success' => 'Успешно дбавяне на дете']);
    }

    public function show(Kid $kid): JsonResponse
    {
        $kid = $kid->load('kid_services.service_data.service');

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

    public function search(Kid $kid, ServiceType $serviceType): JsonResponse
    {
        $data = array();
        $kid = $kid->load('kid_services.service_data.service');
        if ($serviceType->id === 1){
            $services = Service::all();
        } else {
            $services = AdditionalService::all();
        }

        $data['kid'] = $kid;
        $data['services'] = $services;

        return response()->json($data);
    }
}
