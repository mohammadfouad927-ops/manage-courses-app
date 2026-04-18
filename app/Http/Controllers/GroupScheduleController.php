<?php

namespace App\Http\Controllers;

use App\Models\GroupSchedule;
use App\Http\Requests\StoreGroupScheduleRequest;
use App\Http\Requests\UpdateGroupScheduleRequest;

class GroupScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('groupSchedules.index', [
            'groupSchedules' => GroupSchedule::with('group.programSession.trainingProgram')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groupSchedules.create', [
            'groups' => \App\Models\Group::with('programSession.trainingProgram')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupScheduleRequest $request)
    {
        GroupSchedule::create($request->validated());

        return redirect()->route('groupSchedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupSchedule $groupSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupSchedule $groupSchedule)
    {
        return view('groupSchedules.edit', [
            'groupSchedule' => $groupSchedule,
            'groups' => \App\Models\Group::with('programSession.trainingProgram')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupScheduleRequest $request, GroupSchedule $groupSchedule)
    {
        $groupSchedule->update($request->validated());

        return redirect()->route('groupSchedules.index')->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupSchedule $groupSchedule)
    {
        $groupSchedule->delete();

        return redirect()->route('groupSchedules.index')->with('success', 'Schedule deleted successfully.');
    }   
}
