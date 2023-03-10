<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdditionalHourRequest;
use App\Http\Requests\UpdateAdditionalHourRequest;
use App\Models\AdditionalHour;
use App\Models\AdditionalHourStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Redirect;

class AdditionalHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {

        $query = Auth::user()->additionalHours()->with(['status']);

        if($request->has('status')) {
            $status = $request->status;
            $query->whereHas('status', function(Builder $query) use($status) {
                $query->where('code', $status);
            });
        }

        return Inertia::render('Hours/Hours',  [
            'hours' => $query->orderByDesc('created_at')->get(),
            'statuses' => AdditionalHourStatus::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Hours/AddHour', [
            'statuses' => AdditionalHourStatus::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdditionalHourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdditionalHourRequest $request)
    {
        $additional_hour = new AdditionalHour($request->only(['reason', 'hours', 'date']));

        $additional_hour->status()->associate(AdditionalHourStatus::find($request->validated('status')));
        $additional_hour->user()->associate(auth()->user());

        if($additional_hour->save()) {
            session()->flash('alert', ['type' => 'success', 'message' => 'New Hour added']);
        }



        return Redirect::route('hours.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalHour  $additionalHour
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalHour $additionalHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalHour  $additionalHour
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalHour $additional_hour)
    {
        return Inertia::render('Hours/EditHour', [
            'additionalHour' => $additional_hour,
            'statuses' => AdditionalHourStatus::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdditionalHourRequest  $request
     * @param  \App\Models\AdditionalHour  $additionalHour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdditionalHourRequest $request, AdditionalHour $additional_hour)
    {
        $additional_hour->reason = $request->validated('reason');
        $additional_hour->hours = $request->validated('hours');
        $additional_hour->date = $request->validated('date');
        $additional_hour->status()->associate(AdditionalHourStatus::find($request->validated('status')));
        
        if($additional_hour->save()) {
            session()->flash('alert', ['type' => 'success', 'message' => "Hour #{$additional_hour->id} has been updated"]);
        }

        return Redirect::route('hours.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalHour  $additionalHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalHour $additionalHour)
    {
        $additionalHour->delete();

        return Redirect::back();
    }
}
