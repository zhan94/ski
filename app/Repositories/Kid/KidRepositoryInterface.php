<?php

namespace App\Repositories\Kid;

interface KidRepositoryInterface
{

    public function all();

    public function create();

    public function store($inputData);

    public function get($kid);

    public function update($inputData, $kid);

    public function delete($kid);

    public function search($kid, $serviceType);

}
