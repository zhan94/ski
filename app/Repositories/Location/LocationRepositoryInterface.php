<?php

namespace App\Repositories\Location;

Interface LocationRepositoryInterface
{
    public function all();
    public function store($inputData);
    public function get($location);
    public function update($inputData, $location);
    public function delete($location);
}
