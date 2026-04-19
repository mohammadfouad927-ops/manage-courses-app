<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Student;
use App\Models\ProgramSession;
use App\Models\Group;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('enrollments.index',[
            'enrollments' => Enrollment::with(['student', 'programSession.trainingProgram', 'group'])->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enrollments.create', [
            'students' => Student::select('id','nameEn', 'photoPath')->get(),
            'programSessions' => ProgramSession::with([
                'trainingProgram',
                'groups:id,program_session_id,name',
                'groups.groupSchedules:id,group_id,day,start_time,end_time'
                ])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentRequest $request)
    {
        Enrollment::create($request->validated());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        return view('enrollments.edit', [
            'enrollment' => $enrollment->load(['student', 'programSession.trainingProgram', 'group.branch']),
            'students' => Student::all(),
            'programSessions' => ProgramSession::with([
                'trainingProgram',
                'groups:id,program_session_id,name',
                'groups.groupSchedules:id,group_id,day,start_time,end_time'
                ])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
