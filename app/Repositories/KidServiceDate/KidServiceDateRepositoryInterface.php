<?php

namespace App\Repositories\KidServiceDate;

interface KidServiceDateRepositoryInterface
{
    public function store($date, $serviceId): void;
    public function getKidServiceDatesByKidAndService($kid, $service);
}
