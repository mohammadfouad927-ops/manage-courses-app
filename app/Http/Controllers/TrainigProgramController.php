<?php

namespace App\Http\Controllers;

use App\Models\TrainingProgram;
use App\Models\Course;
use App\Http\Requests\StoreTrainingProgramRequest;
use App\Http\Requests\UpdateTrainingProgramRequest;

class TrainigProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('trainingPrograms.index',[
            'trainingPrograms' => TrainingProgram::with('courses')->get(),
            'courses' => Course::where('active',1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingProgramRequest $request)
    {
        $data = $request->validated();

        $program = TrainingProgram::create(['name' => $data['name']]);

        $program->courses()->attach($data['course_ids']);

        return redirect(route('programs.index'))->with('success', 'Program created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingProgram $program)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingProgram $program)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingProgramRequest $request, TrainingProgram $program)
    {
        $trainingProgram = $request->validated();
        
        $program->update(['name' => $trainingProgram['name']]);
        $program->courses()->sync($trainingProgram['course_ids']);

        return redirect(route('programs.index'))->with('success','modfing the program successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingProgram $program)
    {
        $program->courses()->detach();
        $program->delete();
        return redirect(route('programs.index'))->with('success','the program deleted successfully');
    }
}
