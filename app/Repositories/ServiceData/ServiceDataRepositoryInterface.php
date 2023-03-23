<?php

namespace App\Repositories\ServiceData;

interface ServiceDataRepositoryInterface
{
    public function allServiceData();
    public function storeServiceData($inputData);
    public function findServiceData($serviceData);
}
