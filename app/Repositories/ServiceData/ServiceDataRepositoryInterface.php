<?php

namespace App\Repositories\ServiceData;

interface ServiceDataRepositoryInterface
{
    public function allData();
    public function storeData($serviceId, $max);
    public function getData($serviceData);
}
