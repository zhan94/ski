<?php

namespace App\Repositories\Location;

Interface LocationRepositoryInterface
{
    public function allLocations();
    public function storeLocation($inputData);
    public function getLocation($location);
    public function updateLocation($inputData, $location);
    public function deleteLocation($location);
}
