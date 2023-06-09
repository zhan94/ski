<?php

namespace App\Repositories\Kid;

use App\Models\AdditionalService;
use App\Models\Kid;
use App\Models\Service;
use App\Models\ServiceType;

class KidRepository implements KidRepositoryInterface
{
    public function allKids(): array
    {
        return Kid::all()->toArray();
    }

    public function createKid(): array
    {
        $service_types = ServiceType::all();
        $kids_data = array();
        $data = array();
        $kids = Kid::all([
            'id', 'firstname', 'surname', 'lastname', 'birth_date'
        ]);

        foreach ($kids as $kid) {
            $fullName = $kid['firstname'] . ' ' . $kid['surname'] . ' ' . $kid['lastname'];
            $kids_data[] = $kid['id'] . ' ' . $fullName . ' (' . $kid['birth_date'] . 'г.)';
        }

        $data['kids'] = $kids_data;
        $data['service_types'] = $service_types;

        return $data;
    }

    public function storeKid($inputData): void
    {
        $inputData['birth_date'] = date('d-m-Y', strtotime($inputData['birth_date']));
        Kid::create($inputData);
    }

    public function getKid($kid): Kid
    {
        return $kid->load('kid_services.service_data.service');
    }

    public function updateKid($inputData, $kid): void
    {
        $kid->update($inputData);
    }

    public function deleteKid($kid): void
    {
        $kid->delete();
    }

    public function search($kid, $serviceType): array
    {
        $data = array();
        $kid = $kid->load('kid_services.service_data.service');
        if ($serviceType->id === 1) {
            $services = Service::all();
        } else {
            $services = AdditionalService::all();
        }

        $data['kid'] = $kid;
        $data['services'] = $services;

        return $data;
    }
}
