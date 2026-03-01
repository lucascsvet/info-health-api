<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\VOs\Cpf;
use App\Domain\VOs\Phone;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cpf',
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'public_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'public_password',
        'remember_token',
    ];

    protected $appends = ['full_name'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                $name = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
                return $name ?: $this->email ?? 'Usuário';
            },
        );
    }

    public function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value ? Cpf::applyMask($value) : ''),
            set: fn ($value) => Cpf::formatAsNumber($value),
        );
    }

    public function phone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value ? Phone::applyMask($value) : ''),
            set: fn ($value) => Phone::formatAsNumber($value),
        );
    }

    public function clinicalData()
    {
        return $this->hasOne(ClinicalData::class);
    }
}
