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

    /**
     * Status of supp hour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo(AdditionalHourStatus::class, 'status_id');
    }

    /**
     * Return user associated with the supp hour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

}
