<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdditionalHourStatus
 *
 * @property int $id
 * @property string $code
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHourStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHourStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHourStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHourStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHourStatus whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalHourStatus whereId($value)
 * @mixin \Eloquent
 */
class AdditionalHourStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $filable = [
        'code',
        'color'
    ];

}
