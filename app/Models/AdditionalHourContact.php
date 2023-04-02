<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdditionalHourContact extends Model
{
    use HasFactory;


    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'default',
        'user_id'
    ];

    protected $casts = [
        'default' => 'boolean'
    ];


    /**
     * Scope the request to default hour contact
     *
     * @param Builder $query
     * @return void
     */
    public function scopeDefault(Builder $query) : void {
        $query->whereDefault(true);
    }

}
