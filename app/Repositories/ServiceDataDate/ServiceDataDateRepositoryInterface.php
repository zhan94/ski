<?php

namespace App\Repositories\ServiceDataDate;

interface ServiceDataDateRepositoryInterface
{
    public function store($data);
    public function storeServiceDataDates($serviceDataId, $dates);
}
