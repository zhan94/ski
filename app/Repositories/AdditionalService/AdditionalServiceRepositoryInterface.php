<?php

namespace App\Repositories\AdditionalService;

interface AdditionalServiceRepositoryInterface
{
    public function all();
    public function get($additionalService);
    public function store($inputData);
    public function update($inputData, $additionalService);
    public function delete($additionalService);
}
