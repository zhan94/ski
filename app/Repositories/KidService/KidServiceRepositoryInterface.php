<?php

namespace App\Repositories\KidService;

interface KidServiceRepositoryInterface
{
    public function allKidServices();
    public function storeKidService($inputData);
    public function findKidService($kidService);
    public function updateKidService($inputData, $kidService);
    public function destroyKidService($kidService);
    public function drawReport($service, $date_from, $date_to);
}
