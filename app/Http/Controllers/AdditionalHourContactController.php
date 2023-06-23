<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\AdditionalHourContact;
use App\Http\Requests\StoreAdditionalHourContactRequest;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class AdditionalHourContactController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdditionalHourContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdditionalHourContactRequest $request)
    {
        $user = Auth::user();

        $user->additionalHourContacts()->update([
            'default' => false,
            'deleted_at' => Carbon::now(),
        ]);

        $additionalHourContact = new AdditionalHourContact([
            'firstname' => $request->validated('firstname'),
            'lastname' => $request->validated('lastname'),
            'send_at' => $request->validated('send_at'),
            'email' => $request->validated('email'),
            'default' => true
        ]);

        if($user->additionalHourContacts()->save($additionalHourContact)) {
            session()->flash('alert', ['type' => 'success', 'message' => "Contact {$additionalHourContact->firstname} {$additionalHourContact->lastname} has been updated."]);
        }else {
            session()->flash('alert', ['type' => 'danger', 'message' => "An error occured please retry."]);
        }

        return Redirect::back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $additionalHourContact = Auth::user()->additionalHourContactDefault() ?: new AdditionalHourContact;

        return Inertia::render('Profile/Contact/Edit', compact('additionalHourContact'));
    }
}
