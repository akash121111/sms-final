<?php

namespace App\Http\Controllers;

use App\Models\StaffDetail;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\BankDetail;
use App\Models\StaffQualification;
use App\Models\StaffDocument;


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
                'message'=> 'data updated',
                'data'=>$result
        ];
        }
        else{
            return [
                'Status' => 400,
                'message'=> 'something went wrong'
            ];
        }
    }




    public function staff_address_store(Request $request){
        $address=new Address();

        $rules=[
            'street'=>'required',
            'postal_code' => 'required|digits:6',
            'address_type'=>'required',
            'country'=>'required',
            'state'=>'required',
            'staff_id' => 'required|numeric|exists:App\Models\StaffDetail,id'
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
        $address->staff_id=$request->staff_id;

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



    public function staff_address_update(Request $request, $id){

            $address=Address::where('staff_id',$id)->first();
           // return $address;
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
            'staff_id' => 'required|numeric|exists:App\Model\StaffDetail,id'
        ];

            $result=$address->update($request->all());
    
            if($result){
                return [
                    'Status' => 202,
                    'message'=> 'data updated',
                    'data'=>$result
            ];
            }
            else{
                return [
                    'Status' => 400,
                    'message'=> 'something went wrong'
                ];
            }
        }



         public function staff_bank_store(Request $request){

        $bank = new BankDetail();

        $rules=[
            'bank_name'=>'required|string',
            'account_number' => 'required|numeric',
            'ifsc_code'=>'required|alpha_num',
            'staff_id' => 'required|numeric|exists:App\Models\StaffDetail,id'

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $bank->bank_name=$request->bank_name;
        $bank->account_number=$request->account_number;
        $bank->ifsc_code=$request->ifsc_code;
        $bank->account_type=$request->account_type;
        $bank->staff_id=$request->staff_id;

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




         public function staff_bank_update(Request $request, $id){

        $bank=BankDetail::where('staff_id',$id)->first();
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


    public function staff_qualification_store(Request $request){
        $qualification=new StaffQualification();

        $rules=[
            'qualification_type'=>'required',
            'qualification' => 'required',
            'institute_name'=>'required|string|max:255',
            'board_name'=>'required|string',
            'percentage'=>'required|numeric',
            'year'=>'required|numeric',
            'staff_id' => 'required|numeric|exists:App\Models\StaffDetail,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $qualification->qualification_type=$request->qualification_type;
        $qualification->qualification=$request->qualification;
        $qualification->institute_name=$request->institute_name;
        $qualification->board_name=$request->board_name;
        $qualification->percentage=$request->percentage;
        $qualification->year=$request->year;
        $qualification->staff_id=$request->staff_id;

        if($qualification->save()){
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


    public function staff_qualification_update(Request $request, $id ,$type){

        $qualification=StaffQualification::where('staff_id',$id)
                                            ->where('qualification_type',$type)
                                            ->first();
        if(is_null($qualification)){
            return response()->json('Record not Found',404);
        }
        $result=$qualification->update($request->all());

        if($result){
            return [
                'Status' => 202,
                'message'=> 'data updated',
                'data'=>$qualification
        ];
        }
        else{
            return [
                'Status' => 400,
                'message'=> 'something went wrong'
            ];
        }
    }


    public function staff_document_store(Request $request)
    {
        //
        $documents = new StaffDocument();
        $file_name = Carbon::now()->timestamp;
        $path = '/staff/' . $request->staff_id;
        $rules = [
            'aadhar_card' => 'file|required|mimes:pdf,docx',
            'pan_card' => 'file|required|mimes:pdf,docx',
            'resume' => 'file|required|mimes:pdf,docx',
            'address_proof' => 'file|nullable|mimes:pdf,docx',
            'staff_id' => 'required|exists:App\StaffDetail,id'

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!is_null($request->file('aadhar_card'))) {
            $request->file('aadhar_card')->move(public_path($path), '/ac' .$file_name);
            $documents->aadhar_card = url('/api'.$path . '/ac' . $file_name);
        }
        if (!is_null($request->file('pan_card'))) {
            $request->file('pan_card')->move(public_path($path), '/pan' .$file_name);
            $documents->pan_Card = url('/api'.$path . '/pan' . $file_name);
        }
        if (!is_null($request->file('resume'))){
            $request->file('resume')->move(public_path($path), '/r' .$file_name);
            $documents->resume = url('/api'.$path . '/r' . $file_name);
        }
        if(!is_null($request->file('address_proof'))){
            $request->file('address_proof')->move(public_path($path), '/add' .$file_name);
            $documents->address_proof=url('/api'.$path . '/add' . $file_name);
        }
        $documents->staff_id=$request->staff_id;

        if($documents->save()){
            return [
                'Status' => 202,
                'message' => 'staff documents saved'
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
