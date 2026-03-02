<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\ClinicalDataRepositoryInterface;
use App\Repositories\Contracts\EmergencyContactRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    private $userRepository;
    private $emergencyContactRepository;
    private $clinicalDataRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmergencyContactRepositoryInterface $emergencyContactRepository,
        ClinicalDataRepositoryInterface $clinicalDataRepository
    ) {
        $this->userRepository = $userRepository;
        $this->emergencyContactRepository = $emergencyContactRepository;
        $this->clinicalDataRepository = $clinicalDataRepository;
    }

    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $emergencyContact = $this->emergencyContactRepository->create([
                'name' => $data['emergency_contact_name'],
                'phone' => $data['emergency_contact_phone'],
            ]);

            $user = $this->userRepository->create([
                'cpf' => $data['cpf'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => $data['password'],
                'public_password' => $data['public_password'],
            ]);

            $this->clinicalDataRepository->create([
                'user_id' => $user->id,
                'gender' => $data['gender'],
                'blood_type' => $data['blood_type'],
                'emergency_contact_id' => $emergencyContact->id,
                'allergies' => $data['allergies'] ?? null,
                'medications' => $data['medications'] ?? null,
                'diseases' => $data['diseases'] ?? null,
                'surgeries' => $data['surgeries'] ?? null,
            ]);

            return $user;
        });
    }

    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $clinicalData = $user->clinicalData;
            $emergencyContact = $clinicalData?->emergencyContact;

            if ($emergencyContact) {
                $this->emergencyContactRepository->update($emergencyContact, [
                    'name' => $data['emergency_contact_name'],
                    'phone' => $data['emergency_contact_phone'],
                ]);
            }

            $this->userRepository->update($user, [
                'cpf' => $data['cpf'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'public_password' => $data['public_password'],
            ]);

            if ($clinicalData) {
                $this->clinicalDataRepository->update($clinicalData, [
                    'gender' => $data['gender'],
                    'blood_type' => $data['blood_type'],
                    'allergies' => $data['allergies'] ?? null,
                    'medications' => $data['medications'] ?? null,
                    'diseases' => $data['diseases'] ?? null,
                    'surgeries' => $data['surgeries'] ?? null,
                ]);
            }

            return $this->userRepository->findById($user->id);
        });
    }
}
