<?php

namespace App\Repositories\KidServiceDate;

interface KidServiceDateRepositoryInterface
{
    public function store($dates, $serviceId): void;
    public function getKidServiceDatesByKidAndService($kid, $service);
}
