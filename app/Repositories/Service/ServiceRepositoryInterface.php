<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function allServices();

    public function storeService($inputData);

    public function updateService($inputData, $service);

    public function deleteService($service);

    public function findLocationsByService($service);

    public function allSkills();

}
