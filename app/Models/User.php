<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ktp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => bcrypt($value)
        );
    }

    // scope
    public function scopeFilter(Builder $query, array $filter)
    {
        $query->when(
            $filter['search'] ?? false,
            fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%')
        );
    }

    public function scopeGetOccupants(Builder $query)
    {
        $query->where('isAdmin', false);
    }

    public function scopeGetAdmin(Builder $query)
    {
        $query->where('isAdmin', true);
    }

    // relations
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function complain()
    {
        return $this->hasMany(Complain::class);
    }
}
