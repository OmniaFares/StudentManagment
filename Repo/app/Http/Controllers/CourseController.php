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
       $course->Descripton     =$request->input('Descripton');
       if($course->save()){
           return new CourseResource($course);
       }

   } 

   public function show($id)
   {
       //Get Single Article
       $course = Course::findOrFail($id);

       //Return Single Article as a resource
       return new CourseResource($course);
   }

   public function destroy($id)
   {
       //Get Single Article
       $course = Course::findOrFail($id);

       //Delete Single Article with a resource
       if($course->delete()){
           return new CourseResource($course);
       }
   }

   public function search($selected, $valueToSearch)
   {
       $courses = Course::where($selected,$valueToSearch)->get();
       return CourseResource::collection($courses);
   }
}
