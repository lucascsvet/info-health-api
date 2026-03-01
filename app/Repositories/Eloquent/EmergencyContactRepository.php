<?php

namespace App\Repositories\Eloquent;

use App\Models\EmergencyContact;
use App\Repositories\Contracts\EmergencyContactRepositoryInterface;

class EmergencyContactRepository implements EmergencyContactRepositoryInterface
{
    private $eloquent;

    public function __construct(
        EmergencyContact $eloquent
    ) {
        $this->eloquent = $eloquent;
    }

    public function create(array $data): EmergencyContact
    {
        $contact = $this->eloquent->newInstance();
        $contact->fill($data);
        $contact->save();

        return $contact;
    }
}
