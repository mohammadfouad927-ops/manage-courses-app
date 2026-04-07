<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('students.index',["students" => Student::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorestudentRequest $request)
    {
        $student = $request->safe()->except('photo');
        $student['photoPath'] = $request->validated('photo')?->store('avatars', 'public');
        Student::create($student);
        return redirect(route('students.index'))->with('success','Add new Students successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        return view('students.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student):View
    {
        return view('students.edit',['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentRequest $request, student $student)
    {
        $modfiedStudent = $request->safe()->except('photo');
        $photo = $request->validated('photo');
        if($photo){
            if($student->photoPath && $student->photoPath !== 'avatars/default_photo.jpg'){
                Storage::delete($student->photoPath);
            }
            $modfiedStudent['photoPath'] = $photo->store('avatars','public');
        } 
        $student->update($modfiedStudent);
        return redirect(route('students.index'))->with('success','modfied student\'s information successfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        if($student->photoPath && $student->photoPath !== 'avatars/default_photo.jpg'){
            storage::disk('public')->delete($student->photoPath);
        }
        $student->delete();
        return redirect(route('students.index'))->with('success','delete student successfully');
    }
}
