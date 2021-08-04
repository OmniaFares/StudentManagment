<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Resources\Course as CourseResource;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
     public function index($id){
       $courses =  DB:: table ('courses')
       ->join('enrollment', function($join)  use($id){
        $join->on('courses.id', '=', 'enrollment.course')->where('enrollment.student','=',$id); })
       -> select ('courses.*')
       ->get();
       error_log($courses);
        return CourseResource::collection($courses);
    }
    public function index2(){
        $courses = Course::orderBy('id','asc')->get();
       return CourseResource::collection($courses);
   }
   public function store(Request $request)
   {
       $course = $request->isMethod('put') ? Course::findOrFail($request->course_id) : new Course();
       $course->id       =$request->input('course_id');
       $course->Name    =$request->input('Name');
       $course->Code     =$request->input('Code');
       $course->Description     =$request->input('Description');
       if($course->save()){
           return new CourseResource($course);
       }

   } 

   public function show($id)
   {
       $course = Course::findOrFail($id);
       return new CourseResource($course);
   }

   public function destroy($id)
   {
       $course = Course::findOrFail($id);
       if($course->delete()){
           return new CourseResource($course);
       }
   }

   public function search($valueToSearch)
   {
       $courses = Course::where('Name',$valueToSearch)->get();
       return CourseResource::collection($courses);
   }
}
