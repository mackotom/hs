<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdditionalHour
 *
 * @property int $id
 * @property string $reason
 * @property string $hours
 * @property string $date
 * @property int $status_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AdditionalHourStatus $status
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AdditionalHourFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHour whereUserId($value)
 * @mixin \Eloquent
 */
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
