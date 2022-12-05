<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdditionalHourContactRequest;
use App\Http\Requests\UpdateAdditionalHourContactRequest;
use App\Models\AdditionalHourContact;

class AdditionalHourContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdditionalHourContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdditionalHourContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalHourContact $additionalHourContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalHourContact $additionalHourContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdditionalHourContactRequest  $request
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdditionalHourContactRequest $request, AdditionalHourContact $additionalHourContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalHourContact  $additionalHourContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalHourContact $additionalHourContact)
    {
        //
    }
}
