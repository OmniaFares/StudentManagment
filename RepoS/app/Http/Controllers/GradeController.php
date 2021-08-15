<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Resources\Grade as GradeResource;
use Illuminate\Support\Facades\DB;


class GradeController extends Controller
{
   public function show($id,$courseid){
      // error_log($id,$courseid);
    $grades = Grade::where('courseID',$courseid)->where('studentID',$id)->get();
    return GradeResource::collection($grades);
   }
}
