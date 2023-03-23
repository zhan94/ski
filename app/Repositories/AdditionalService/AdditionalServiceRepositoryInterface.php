<?php

namespace App\Repositories\AdditionalService;

interface AdditionalServiceRepositoryInterface
{
    public function allAdditionalServices();
    public function findAdditionalService($additionalService);
    public function storeAdditionalService($inputData);
    public function updateAdditionalService($inputData, $additionalService);
    public function destroyAdditionalService($additionalService);
}
