<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function allServices();
    public function storeService($inputData);
    public function updateService($inputData, $service);
    public function destroyService($service);
    public function findLocationsByService($service);

}
