<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\BankDetail;

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




     public function student_address_store(Request $request){
        $address=new Address();

        $rules=[
            'street'=>'required',
            'postal_code' => 'required|digits:6',
            'address_type'=>'required',
            'country'=>'required',
            'state'=>'required',
            'student_id' => 'required|numeric|exists:App\Models\Student,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $address->address_type=$request->address_type;
        $address->house_number=$request->house_number;
        $address->street=$request->street;
        $address->city=$request->city;
        $address->state=$request->state;
        $address->country=$request->country;
        $address->postal_code=$request->postal_code;
        $address->near_by=$request->near_by;
        $address->student_id=$request->student_id;

        if($address->save()){
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



    public function student_address_update(Request $request, $id){

            $address=Address::find($id);
            if(is_null($address)){
                return response()->json('Record not Found',404);
            }

 $rules=[
            'street'=>'required',
            'city'=>'required',
            'postal_code' => 'required|digits:6',
            'address_type'=>'required',
            'country'=>'required',
            'state'=>'required',
            'student_id' => 'required|numeric|exists:App\Model\Student,id'
        ];

            $result=$address->update($request->all());
    
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



        public function student_bank_store(Request $request){

            $bank = new BankDetail();
    
            $rules=[
                'bank_name'=>'required|string',
                'account_number' => 'required|numeric',
                'ifsc_code'=>'required|string',
                'student_id' => 'required|numeric|exists:App\Models\Student,id'
    
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }
    
            $bank->bank_name=$request->bank_name;
            $bank->account_number=$request->account_number;
            $bank->ifsc_code=$request->ifsc_code;
            $bank->account_type=$request->account_type;
            $bank->student_id=$request->student_id;
    
            if($bank->save()){
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
    
    
    
    
             public function student_bank_update(Request $request, $id){
    
            $bank=BankDetail::where('student_id',$id)->first();
            if(is_null($bank)){
                return response()->json('Record not Found',404);
            }
            $result=$bank->update($request->all());
    
            if($result){
                return [
                    'Status' => 202,
                    'message'=> 'data updated',
                    'data'=>$bank
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
