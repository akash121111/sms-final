<?php

namespace App\Http\Controllers;

use App\Models\StaffDetail;
use Illuminate\Http\Request;
use App\Models\Address;

use Carbon\Carbon;
use Validator;

class StaffDetailController extends Controller
{
    

    public function staff_store(Request $request){

        $staff=new StaffDetail();

        $rules=[
            'first_name'=>'required|string|max:255',
            'last_name' => 'nullable',
            'contact1'=>'required|numeric',
            'contact2'=>'nullable|required',
            'email'=>'nullable|email',
            'dob'=>'required|date',
            'gender' => 'required|alpha',
            'caste' => 'nullable|string',
            'marital_status'=> 'nullable|string',
            'nationality' => 'required|string',
            // 'blood_group' => 'nullable|string|max:2',
            'experience'  =>'required|numeric|max:40',
            'previous_school' => 'nullable|string|max:255',
            'job_quit_reason'=>'nullable|string',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' =>'required|numeric',
            'aadhar_no' => 'required|numeric|digits:12',
            
            
            
        
            

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $staff->first_name=$request->first_name;
        $staff->last_name=$request->last_name;
        $staff->contact1 =$request->contact1;
        $staff->contact2 =$request->contact2;
        $staff->email=$request->email;
        $staff->dob=$request->dob;
        $staff->aadhar_no=$request->aadhar_no;
        $staff->picture=$request->picture;
        $staff->gender=$request->gender;
        $staff->caste=$request->caste;
        $staff->marital_status=$request->marital_status;
        $staff->nationality=$request->nationality;
        // $staff->blood_group=$request->blood_group;
        $staff->experience=$request->experience;
        $staff->previous_school=$request->previous_school;
        $staff->job_quit_reason=$request->job_quit_reason;
        $staff->father_name=$request->father_name;
        $staff->mother_name=$request->mother_name;
        $staff->guardian_name=$request->guardian_name;
        $staff->guardian_contact=$request->guardian_contact;
        $staff->is_confirmed=$request->is_confirmed;
        
       
       
        

        if($staff->save()){
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


    public function staff_update(Request $request, $id){

        $staff=StaffDetail::find($id);
        if(is_null($staff)){
            return response()->json('Record not Found',404);
        }
        $result=$staff->update($request->only(['contact1','contact2','email','picture','marital_status','blood_group','guardian_name','guardian_contact','is_confirmed','updated_at']));

        

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
