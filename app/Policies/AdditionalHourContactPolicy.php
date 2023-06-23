<?php

namespace App\Policies;

use App\Models\AdditionalHourContact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdditionalHourContactPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AdditionalHourContact $additionalHourContact)
    {
        return $user->id === $additionalHourContact->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AdditionalHourContact $additionalHourContact)
    {
        
        return $user->id === $additionalHourContact->user_id;

    }



}
