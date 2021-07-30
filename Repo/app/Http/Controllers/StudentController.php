<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;

class StudentController extends Controller
{
    public function index(){
        $students = Student::orderBy('id','asc')->get();
        return StudentResource::collection($students);
    }
    // public function index2(){
    //     $PassedData = Student::orderBy('id')->get();
    //     return view('welcome',['PassedData' => $PassedData,]);

    // }
    public function store(Request $request)
    {
        $student = $request->isMethod('put') ? Student::findOrFail($request->student_id) : new Student();
        $student->id       =$request->input('student_id');
        $student->FirstName    =$request->input('FirstName');
        $student->LastName     =$request->input('LastName');
        $student->Identifier     =$request->input('Identifier');
        $student->Email     =$request->input('Email');
        $student->DateOfBirth     =$request->input('DateOfBirth');
        $student->Level     =$request->input('Level');
        $student->Program     =$request->input('Program');

        if($student->save()){
            return new StudentResource($student);

        }

    } 

    public function show($id)
    {
        //Get Single Article
        $student = Student::findOrFail($id);

        //Return Single Article as a resource
        return new StudentResource($student);
    }

    public function destroy($id)
    {
        //Get Single Article
        $student = Student::findOrFail($id);

        //Delete Single Article with a resource
        if($student->delete()){
            return new StudentResource($student);
        }
    }

    public function search($selected, $valueToSearch)
    {
        $students = Student::where($selected,$valueToSearch)->get();
        return StudentResource::collection($students);

    }
}
