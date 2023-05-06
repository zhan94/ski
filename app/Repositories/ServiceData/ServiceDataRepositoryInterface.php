<?php

namespace App\Repositories\ServiceData;

interface ServiceDataRepositoryInterface
{
    public function all();
    public function store($serviceId, $max);
    public function get($serviceData);
}
