<?php

namespace App\Repositories\Eloquent;

use App\Models\BloodType;
use App\Repositories\Contracts\BloodTypeRepositoryInterface;
use Illuminate\Support\Collection;

class BloodTypeRepository implements BloodTypeRepositoryInterface
{
    private $eloquent;

    public function __construct(
        BloodType $eloquent
    ) {
        $this->eloquent = $eloquent;
    }

    public function all(): Collection
    {
        return $this->eloquent->newQuery()->orderBy('id')->get();
    }
}
