<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Validator;

class StudentController extends Controller
{

    public function student_store(Request $request){

        $student=new Student();

        $rules=[
            'first_name'=>'required|string|max:255',
            'last_name' => 'nullable|alpha',
            'contact'=>'required|numeric',
            'email'=>'nullable|email',
            'dob'=>'required|date',
            'gender' => 'required',
            'caste' => 'nullable',
            'nationality' => 'nullable|alpha',
            'place_of_birth'=> 'required',
            'blood_group' => 'nullable',
            'previous_school' => 'nullable',
            'previous_class'=>'required|numeric',
            'leaving_reason' => 'nullable',
            'refrence' => 'nullable',
            'aadhar_no' => 'required|numeric|digits:12',
            
            
            
        
            

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->contact =$request->contact;
        $student->email=$request->email;
        $student->dob=$request->dob;
        $student->aadhar_no=$request->aadhar_no;
        $student->picture=$request->picture;
        $student->family_picture=$request->family_picture;
        $student->gender=$request->gender;
        $student->caste=$request->caste;
        $student->nationality=$request->nationality;
        $student->place_of_birth=$request->place_of_birth;
        $student->blood_group=$request->blood_group;
        $student->previous_school=$request->previous_school;
        $student->previous_class=$request->previous_class;
        $student->leaving_reason=$request->leaving_reason;
        $student->refrence=$request->refrence;
        $student->is_confirmed=$request->is_confirmed;
        
       
       
        

        if($student->save()){
            return [
                'Status' => 202,
                'message'=> 'data saved'
        ];
        }
        else{
            return [
                'Status' => 400,
                'message'=> 'something went wrong'
            ];
        }

    }


    public function student_update(Request $request, $id){

        $student=Student::find($id);
        if(is_null($student)){
            return response()->json('Record not Found',404);
        }
        $result=$student->update($request->only(['contact','last_name','email','picture','family_picture','updated_at']));

        

        if($result){
            return [
                'Status' => 202,
                'message'=> 'data updated'
        ];
        }
        else{
            return [
                'Status' => 400,
                'message'=> 'something went wrong'
            ];
        }
    }



}
