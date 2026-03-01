<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface BloodTypeRepositoryInterface
{
    public function all(): Collection;
}
