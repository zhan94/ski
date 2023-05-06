<?php

namespace App\Repositories\ReportRepository;

interface ReportRepositoryInterface
{
    public function get($service, $dateFrom, $dateTo): array;
}
