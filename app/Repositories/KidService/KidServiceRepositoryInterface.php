<?php

namespace App\Repositories\KidService;

interface KidServiceRepositoryInterface
{
    public function allKidServices();
    public function storeKidService($inputData);
    public function getKidService($kidService);
    public function updateKidService($inputData, $kidService);
    public function deleteKidService($kidService);
    public function getByKidAndService($kid, $service): array|null;
}
