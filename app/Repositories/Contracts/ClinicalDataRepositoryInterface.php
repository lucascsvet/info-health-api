<?php

namespace App\Repositories\Contracts;

use App\Models\ClinicalData;

interface ClinicalDataRepositoryInterface
{
    public function create(array $data): ClinicalData;

    public function update(ClinicalData $clinicalData, array $data): ClinicalData;
}
