<?php

namespace App\Repositories\Eloquent;

use App\Models\ClinicalData;
use App\Repositories\Contracts\ClinicalDataRepositoryInterface;

class ClinicalDataRepository implements ClinicalDataRepositoryInterface
{
    private $eloquent;

    public function __construct(
        ClinicalData $eloquent
    ) {
        $this->eloquent = $eloquent;
    }

    public function create(array $data): ClinicalData
    {
        $clinicalData = $this->eloquent->newInstance();
        $clinicalData->fill($data);
        $clinicalData->save();

        return $clinicalData;
    }
}
