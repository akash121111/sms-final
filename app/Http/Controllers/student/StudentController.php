<?php

namespace App\Http\Controllers\student;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    

    public function student_store(Request $request){

        $student=new Student();

        $rules=[
            'first_name'=>'required|alpha',
            'last_name' => 'nullable|alpha',
            'contact'=>'required|numeric',
            'email'=>'nullable|email',
            'dob'=>'required|date',
            'gender' => 'required',
            'caste' => 'nullable|alpha',
            'nationality' => 'nullable|alpha',
            'place_of_birth'=> 'required|alpha',
            'blood_group' => 'nullable|alpha',
            'previous_school' => 'nullable|alpha',
            'previous_class'=>'required|numeric',
            'leaving_reason' => 'nullable|alpha',
            'refrence' => 'nullable|alpha',
            'is_confirmed' => '0|1',
            'aadhar_no' => 'required|numeric|digits:12'
            
            
            
        
            

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->contacts=$request->contact;
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


    // public function addressStore(Request $request){
    //     $address=new Address();

    //     $rules=[
    //         'city'=>'required',
    //         'postal_code' => 'required|digits:6',
    //         'address_type_id'=>'required|numeric|exists:App\AddressType,id',
    //         'student_id' => 'required|numeric|exists:App\Student,id'
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if($validator->fails()){
    //         return response()->json($validator->errors(),400);
    //     }

    //     $address->street=$request->street;
    //     $address->near_by=$request->near_by;
    //     $address->city=$request->city;
    //     $address->postal_code=$request->postal_code;
    //     $address->address_type_id=$request->address_type_id;
    //     $address->student_id=$request->student_id;

    //     if($address->save()){
    //         return [
    //             'Status' => 202,
    //             'message'=> 'data saved'
    //     ];
    //     }
    //     else{
    //         return [
    //             'Status' => 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }
    // }



    // public function medicalStore(Request $request){

    //     $medical=new StudentMedical();

    //     $rules=[
    //         'blood_group'=>'string|digits:2',
    //         'height' => 'required',
    //         'weight'=>'required',
    //         'student_id' => 'required|exists:App\Student,id'

    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if($validator->fails()){
    //         return response()->json($validator->errors(),400);
    //     }

    //     $medical->blood_group=$request->blood_group;
    //     $medical->health_report=$request->health_report;
    //     $medical->height=$request->height;
    //     $medical->weight=$request->weight;
    //     $medical->health_issue=$request->health_issue;
    //     $medical->student_id=$request->student_id;

    //     if($medical->save()){
    //         return [
    //             'Status' => 202,
    //             'message'=> 'data saved'
    //     ];
    //     }
    //     else{
    //         return [
    //             'Status' => 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }

    // }

    // public function documentStore(Request $request){

    //     $documents=new StudentDocument();
    //     $file_name = Carbon::now()->timestamp;

    //     $rules = [
    //         'aadhar_card' => 'file|required|mimes:pdf,docx,jpeg,jpg,png',
    //         'picture' => 'file|required|image',
    //         'birth_certificate' => 'file|required|mimes:pdf',
    //         'previous_tc' => 'file|required|mimes:pdf',
    //         'student_id' => 'required|exists:App\Student,id',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $path = '/student/' . $request->student_id;

    //     if (!is_null($request->file('aadhar_card'))) {
    //         $request->file('aadhar_card')->move(public_path($path), '/ac' .$file_name);
    //         $documents->aadhar_card = url('api/'.$path . '/ac' . $file_name);
    //     }
    //     if (!is_null($request->file('birth_certificate'))){
    //         $request->file('birth_certificate')->move(public_path($path), '/birth' .$file_name);
    //         $documents->birth_Certificate = url('api/'.$path . '/birth' . $file_name);
    //     }
    //     if(!is_null($request->file('picture'))){
    //         $request->file('picture')->move(public_path($path), '/pic' .$file_name);
    //         $documents->picture= url('api/'.$path . '/pic' . $file_name);
    //     }
    //     if(!is_null($request->file('medical_report'))){
    //         $request->file('medical_report')->move(public_path($path), '/mr' .$file_name);
    //         $documents->medical_report = url( 'api/'.$path . '/mr' . $file_name);
    //     }
    //     if(!is_null($request->file('previous_tc'))) {
    //         $request->file('previous_tc')->move(public_path($path), '/ptc' .$file_name);
    //         $documents->previous_tc = url( 'api/'.$path . '/ptc' . $file_name);
    //     }

    //     if(!is_null($request->file('father_id'))) {
    //         $request->file('father_id')->move(public_path($path), '/fid' .$file_name);
    //         $documents->father_id = url( 'api/'.$path . '/fid' . $file_name);
    //     }

    //     if(!is_null($request->file('mother_id'))) {
    //         $request->file('mother_id')->move(public_path($path), '/mid' .$file_name);
    //         $documents->mother_id = url( 'api/'.$path . '/mid' . $file_name);
    //     }

    //     $documents->student_id=$request->student_id;

    //     if($documents->save()){
    //         return [
    //             'Status' => 202,
    //             'message' => 'teacher documents saved'
    //         ];
    //     }
    //     else{
    //         return [
    //             'Status'=> 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }
    // }

    // public function bankStore(Request $request){

    //     $bank = new StudentBankDetail();

    //     $rules=[
    //         'bank_name'=>'required|alpha',
    //         'account_no' => 'required|numeric',
    //         'ifsc'=>'required|alpha_num',
    //         'student_id' => 'required|exists:App\exists:App\Student,id,id'

    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if($validator->fails()){
    //         return response()->json($validator->errors(),400);
    //     }

    //     $bank->bank_name=$request->bank_name;
    //     $bank->account_no=$request->account_no;
    //     $bank->ifsc=$request->ifsc;
    //     $bank->student_id=$request->student_id;

    //     if($bank->save()){
    //         return [
    //             'Status' => 202,
    //             'message'=> 'data saved'
    //     ];
    //     }
    //     else{
    //         return [
    //             'Status' => 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }
    // }

    //update controllers

    
    // public function updateAddress(Request $request, $id){

    //     $address=Address::find($id);
    //     if(is_null($address)){
    //         return response()->json('Record not Found',404);
    //     }
    //     $result=$address->update($request->all());

    //     if($result){
    //         return [
    //             'Status' => 202,
    //             'message'=> 'data updated'
    //     ];
    //     }
    //     else{
    //         return [
    //             'Status' => 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }
    // }


    // public function updateMedical(Request $request, $id){

    //     $medical=StudentMedical::findOrFail($id);
    //     if(is_null($medical)){
    //         return response()->json('Record not Found',404);
    //     }
    //     $result=$medical->update($request->all());

    //     if($result){
    //         return [
    //             'Status' => 202,
    //             'message'=> 'data updated',
    //             'date' => $medical
    //     ];
    //     }
    //     else{
    //         return [
    //             'Status' => 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }
    // }


    // public function updateBank(Request $request, $id){

    //     $bank=StudentBankDetail::findOrFail($id);
    //     if(is_null($bank)){
    //         return response()->json('Record not Found',404);
    //     }
    //     $result=$bank->update($request->all());

    //     if($result){
    //         return [
    //             'Status' => 202,
    //             'message'=> 'data updated',
    //             'data'=>$bank
    //     ];
    //     }
    //     else{
    //         return [
    //             'Status' => 400,
    //             'message'=> 'something went wrong'
    //         ];
    //     }
    // }



}
