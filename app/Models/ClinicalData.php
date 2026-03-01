<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ClinicalData extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'blood_type',
        'emergency_contact_id',
        'allergies',
        'medications',
        'diseases',
        'surgeries',
    ];

    protected $appends = [
        'gender_description',
        'blood_type_description',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    public function genderDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->gender?->description ?? '',
        );
    }

    public function bloodTypeDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->bloodType?->description ?? '',
        );
    }

    public function emergencyContactName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->emergencyContact?->name ?? '',
        );
    }

    public function emergencyContactPhone(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->emergencyContact?->phone ?? '',
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender');
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class, 'blood_type');
    }

    public function emergencyContact()
    {
        return $this->belongsTo(EmergencyContact::class);
    }
}
