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

    public function findById(int $id): User
    {
        return $this->eloquent->newQuery()
            ->with('clinicalData')
            ->findOrFail($id);
    }

    public function exists(int $id): bool
    {
        return $this->eloquent->newQuery()->where('id', $id)->exists();
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

    public function update(User $user, array $data): User
    {
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
