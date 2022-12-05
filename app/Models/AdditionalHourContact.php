<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
