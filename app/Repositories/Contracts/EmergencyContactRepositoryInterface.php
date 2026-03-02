<?php

namespace App\Repositories\Contracts;

use App\Models\EmergencyContact;

interface EmergencyContactRepositoryInterface
{
    public function create(array $data): EmergencyContact;

    public function update(EmergencyContact $contact, array $data): EmergencyContact;
}
