<?php

namespace App\Repositories\Kid;

interface KidRepositoryInterface
{

    public function allKids();
    public function createKid();
    public function storeKid($inputData);
    public function findKid($kid);
    public function updateKid($inputData, $kid);
    public function destroyKid($kid);
    public function search($kid, $serviceType);

}
