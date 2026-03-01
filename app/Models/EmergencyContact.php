<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'phone'];
}
