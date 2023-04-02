<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Return all hours of user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function additionalHours() : HasMany {
        return $this->hasMany(AdditionalHour::class);
    }

    /**
     * Return all contact to send mail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function additionalHourContact() : HasMany {
        return $this->hasMany(AdditionalHourContact::class);
    }

    /**
     * Return the default contact hour
     *
     * @return additionalHourContact|null
     */
    public function additionalHourContactDefault() : additionalHourContact|null {
        return $this->additionalHourContact()->default()->first();
    }



}
