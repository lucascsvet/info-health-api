<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $eloquent;

    public function __construct(
        User $eloquent
    ) {
        $this->eloquent = $eloquent;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->eloquent->newQuery()
            ->where('email', $email)
            ->first();
    }

    public function create(array $data): User
    {
        $user = $this->eloquent->newInstance();
        $user->fill($data);
        $user->save();

        return $user;
    }
}
