<?php

namespace App\Models;

use App\Domain\VOs\Phone;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'phone'];

    public function phone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value ? Phone::applyMask($value) : ''),
            set: fn ($value) => Phone::formatAsNumber($value),
        );
    }
}
