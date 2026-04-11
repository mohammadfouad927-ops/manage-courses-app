<?php

namespace App\Http\Controllers;

use App\Models\ProgramSession;
use App\Http\Requests\StoreProgramSessionRequest;
use App\Http\Requests\UpdateProgramSessionRequest;
use App\Models\TrainingProgram;

class ProgramSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ProgramSessions.index',[
            'programSessions' => ProgramSession::with('trainingProgram')->paginate(20),
            'trainingPrograms' => TrainingProgram::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramSessionRequest $request)
    {
        ProgramSession::create($request->validated());
        return redirect()->route('program-sessions.index')->with('success', 'Program session created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramSession $programSession)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramSession $programSession)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramSessionRequest $request, ProgramSession $programSession)
    {
        $programSession->update($request->validated());
        return redirect()->route('program-sessions.index')->with('success', 'Program session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramSession $programSession)
    {
        $programSession->delete();
        return redirect()->route('program-sessions.index')->with('success', 'Program session deleted successfully.');
    }
}
