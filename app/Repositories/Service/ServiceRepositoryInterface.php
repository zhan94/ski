<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function all();

    public function store($inputData);

    public function update($inputData, $service);

    public function delete($service);

    public function findLocationsByService($service);

    public function allSkills();

}
