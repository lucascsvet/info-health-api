<?php

namespace App\Repositories\Eloquent;

use App\Models\Gender;
use App\Repositories\Contracts\GenderRepositoryInterface;
use Illuminate\Support\Collection;

class GenderRepository implements GenderRepositoryInterface
{
    private $eloquent;

    public function __construct(
        Gender $eloquent
    ) {
        $this->eloquent = $eloquent;
    }

    public function all(): Collection
    {
        return $this->eloquent->newQuery()->orderBy('id')->get();
    }
}
