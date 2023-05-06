<?php

namespace App\Repositories\KidService;

interface KidServiceRepositoryInterface
{
    public function all();
    public function store($inputData);
    public function get($kidService);
    public function update($inputData, $kidService);
    public function delete($kidService);
    public function getByKidAndService($kid, $service): array|null;
}
