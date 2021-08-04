<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Http\Resources\Enrollment as EnrollmentResource;
use Illuminate\Support\Facades\DB;


class EnrollmentController extends Controller
{
    public function index($id){
       $courses =  DB:: table ('enrollment')
       ->join('courses', function($join)  use($id){
        $join->on('courses.id', '=', 'enrollment.course')->where('enrollment.student','=',$id); })
       -> select ('courses.Name')
       ->get();
       error_log($courses);
        return EnrollmentResource::collection($courses);
    }
}
