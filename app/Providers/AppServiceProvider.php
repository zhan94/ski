<?php

namespace App\Providers;

use App\Repositories\AdditionalService\AdditionalServiceRepository;
use App\Repositories\AdditionalService\AdditionalServiceRepositoryInterface;
use App\Repositories\Card\CardRepository;
use App\Repositories\Card\CardRepositoryInterface;
use App\Repositories\Equip\EquipRepositoryInterface;
use App\Repositories\Equip\EquipRepository;
use App\Repositories\Kid\KidRepository;
use App\Repositories\Kid\KidRepositoryInterface;
use App\Repositories\KidService\KidServiceRepository;
use App\Repositories\KidService\KidServiceRepositoryInterface;
use App\Repositories\ReportRepository\ReportRepository;
use App\Repositories\ReportRepository\ReportRepositoryInterface;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\ServiceData\ServiceDataRepository;
use App\Repositories\ServiceData\ServiceDataRepositoryInterface;
use App\Repositories\ServiceDataDate\ServiceDataDateRepository;
use App\Repositories\ServiceDataDate\ServiceDataDateRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Location\LocationRepositoryInterface;
use App\Repositories\Location\LocationRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(EquipRepositoryInterface::class, EquipRepository::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(KidRepositoryInterface::class, KidRepository::class);
        $this->app->bind(KidServiceRepositoryInterface::class, KidServiceRepository::class);
        $this->app->bind(AdditionalServiceRepositoryInterface::class, AdditionalServiceRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ServiceDataRepositoryInterface::class, ServiceDataRepository::class);
        $this->app->bind(ServiceDataDateRepositoryInterface::class, ServiceDataDateRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
