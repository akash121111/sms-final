<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\BankDetail;
use App\Models\ParentDetail;
use App\Models\StudentAcademic;
use App\Models\StudentDocument;

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


        public function parent_store(Request $request){

            $parent=new ParentDetail();
    
            $rules=[
                'father_name'=>'required|string|max:255',
                'father_contact1'=>'required|numeric',
                'father_contact2'=>'nullable|numeric',
                'father_email'=>'required|email',
                'father_dob'=>'required|date',
                'father_occupation'=>'required|string|max:255',
                'father_picture' => 'nullable',

                'mother_name'=>'required|string|max:255',
                'mother_contact1'=>'required|numeric',
                'mother_contact2'=>'nullable|numeric',
                'mother_email'=>'nullable|email',
                'mother_dob'=>'required|date',
                'mother_occupation'=>'required|string|max:255',
                'mother_picture' => 'nullable',

                'local_gardian_name'=>'nullable|string|max:255',
                'local_gardian_contact'=>'nullable|numeric',
                'local_gardian_email'=>'nullable|email',

                'student_id' => 'required|numeric|exists:App\Models\Student,id'
                
            
                
    
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }
            $parent->father_name=$request->father_name;
            $parent->father_contact1=$request->father_contact1;
            $parent->father_contact2 =$request->father_contact2;
            $parent->father_email=$request->father_email;
            $parent->father_dob=$request->father_dob;
            $parent->father_occupation=$request->father_occupation;
            $parent->father_picture=$request->father_picture;

            $parent->mother_name=$request->mother_name;
            $parent->mother_contact1=$request->mother_contact1;
            $parent->mother_contact2 =$request->mother_contact2;
            $parent->mother_email=$request->mother_email;
            $parent->mother_dob=$request->mother_dob;
            $parent->mother_occupation=$request->mother_occupation;
            $parent->mother_picture=$request->mother_picture;

            $parent->local_gardian_name=$request->local_gardian_name;
            $parent->local_gardian_contact=$request->local_gardian_contact;
            $parent->local_gardian_email =$request->local_gardian_email;
    
            $parent->student_id=$request->student_id;
            
           
           
            
    
            if($parent->save()){
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



    public function parent_update(Request $request, $id){

        $parent=ParentDetail::where('student_id',$id)->first();

        if(is_null($parent)){
            return response()->json('Record not Found',404);
        }


        $rules=[
            'father_name'=>'string|max:255',
            'father_contact1'=>'numeric',
            'father_contact2'=>'numeric',
            'father_email'=>'email',
            'father_dob'=>'date',
            'father_occupation'=>'string|max:255',
            'father_picture' => 'nullable',

            'mother_name'=>'string|max:255',
            'mother_contact1'=>'numeric',
            'mother_contact2'=>'numeric',
            'mother_email'=>'email',
            'mother_dob'=>'date',
            'mother_occupation'=>'string|max:255',
            'mother_picture' => 'nullable',

            'local_gardian_name'=>'string|max:255',
            'local_gardian_contact'=>'numeric',
            'local_gardian_email'=>'email'
            
        
            

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $result=$parent->update($request->all());

        if($result){
            return [
                'Status' => 202,
                'message'=> 'data updated',
                'data'=>$parent
        ];
        }
        else{
            return [
                'Status' => 400,
                'message'=> 'something went wrong'
            ];
        }
    }

    

    public function student_academic_store(Request $request){

        $academic = new StudentAcademic();

        $rules=[
            'registration_number'=>'required|numeric',
            'admission_number' => 'required|string',
            'admission_date'=>'required|date',
            'enrollment_number'=>'required|numeric',
            'roll_number'=>'required|numeric',
            'admission_class'=>'required|string',


            'student_id' => 'required|numeric|exists:App\Models\Student,id'

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $academic->registration_number=$request->registration_number;
        $academic->admission_number=$request->admission_number;
        $academic->admission_date=$request->admission_date;
        $academic->enrollment_number=$request->enrollment_number;
        $academic->roll_number=$request->roll_number;
        $academic->admission_class=$request->admission_class;
        $academic->student_id=$request->student_id;

        if($academic->save()){
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




         public function student_academic_update(Request $request, $id){

        $academic=StudentAcademic::find($id);
        if(is_null($academic)){
            return response()->json('Record not Found',404);
        }
        $result=$academic->update($request->all());

        if($result){
            return [
                'Status' => 202,
                'message'=> 'data updated',
                'data'=>$academic
        ];
        }
        else{
            return [
                'Status' => 400,
                'message'=> 'something went wrong'
            ];
        }
    }


    public function student_document_store(Request $request)
    {
        //
        $documents = new StudentDocument();
        $file_name = Carbon::now()->timestamp;
        $path = '/student/' . $request->student_id;
        $rules = [
            'aadhar_card' => 'file|required|mimes:pdf,docx',
            'birth_certificate' => 'file|required|mimes:pdf,docx',
            'tc' => 'file|nullable|mimes:pdf,docx',
            'father_aadhar' => 'file|nullable|mimes:pdf,docx',
            'mother_aadhar' => 'file|nullable|mimes:pdf,docx',
            'address_proof' => 'file|nullable|mimes:pdf,docx',
            'student_id' => 'required|exists:App\Student,id'
            
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!is_null($request->file('aadhar_card'))) {
            $request->file('aadhar_card')->move(public_path($path), '/ac' .$file_name);
            $documents->aadhar_card = url('/api'.$path . '/ac' . $file_name);
        }
        if (!is_null($request->file('birth_certificate'))) {
            $request->file('birth_certificate')->move(public_path($path), '/bc' .$file_name);
            $documents->birth_certificate = url('/api'.$path . '/bc' . $file_name);
        }
        if (!is_null($request->file('tc'))){
            $request->file('tc')->move(public_path($path), '/tc' .$file_name);
            $documents->tc = url('/api'.$path . '/tc' . $file_name);
        }
        if (!is_null($request->file('father_aadhar'))){
            $request->file('father_aadhar')->move(public_path($path), '/fa' .$file_name);
            $documents->father_aadhar = url('/api'.$path . '/fa' . $file_name);
        }
        if (!is_null($request->file('mother_aadhar'))){
            $request->file('mother_aadhar')->move(public_path($path), '/ma' .$file_name);
            $documents->mother_aadhar = url('/api'.$path . '/ma' . $file_name);
        }
        if(!is_null($request->file('address_proof'))){
            $request->file('address_proof')->move(public_path($path), '/add' .$file_name);
            $documents->address_proof=url('/api'.$path . '/add' . $file_name);
        }
        $documents->student_id=$request->student_id;

        if($documents->save()){
            return [
                'Status' => 202,
                'message' => 'student documents saved'
            ];
        }
        else{
            return [
                'Status'=> 400,
                'message'=> 'something went wrong'
            ];
        }

    }

}
