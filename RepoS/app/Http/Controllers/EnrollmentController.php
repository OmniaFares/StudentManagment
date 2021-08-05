<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Http\Resources\Enrollment as EnrollmentResource;
use Illuminate\Support\Facades\DB;


class EnrollmentController extends Controller
{
    public function Enroll(Request $request)
    {
        //error_log("hna");
        $enroll =  $request->isMethod('put') ?  : new Enrollment();
        $enroll->student       =$request->input('student');
        $enroll->course    =$request->input('course');

        if($enroll->save()){
            return new EnrollmentResource($enroll);

        }
    }
}
