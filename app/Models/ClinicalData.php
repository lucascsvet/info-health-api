<?php

namespace App\Models;

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
