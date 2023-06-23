<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AdditionalHourContact
 *
 * @property int $id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property int $send_at
 * @property bool $default
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|AdditionalHourContact default()
 * @method static \Database\Factories\AdditionalHourContactFactory factory(...$parameters)
 * @method static Builder|AdditionalHourContact newModelQuery()
 * @method static Builder|AdditionalHourContact newQuery()
 * @method static \Illuminate\Database\Query\Builder|AdditionalHourContact onlyTrashed()
 * @method static Builder|AdditionalHourContact query()
 * @method static Builder|AdditionalHourContact whereCreatedAt($value)
 * @method static Builder|AdditionalHourContact whereDefault($value)
 * @method static Builder|AdditionalHourContact whereDeletedAt($value)
 * @method static Builder|AdditionalHourContact whereEmail($value)
 * @method static Builder|AdditionalHourContact whereFirstname($value)
 * @method static Builder|AdditionalHourContact whereId($value)
 * @method static Builder|AdditionalHourContact whereLastname($value)
 * @method static Builder|AdditionalHourContact whereSendAt($value)
 * @method static Builder|AdditionalHourContact whereUpdatedAt($value)
 * @method static Builder|AdditionalHourContact whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|AdditionalHourContact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AdditionalHourContact withoutTrashed()
 * @mixin \Eloquent
 */
class AdditionalHourContact extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'default',
        'send_at',
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

    /**
     * Return the contact user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }

}
