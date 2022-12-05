<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'hours',
        'date'
    ];


    public function status() {
        return $this->belongsTo(AdditionalHourStatus::class, 'status_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
