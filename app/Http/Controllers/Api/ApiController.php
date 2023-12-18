<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    

    public function index(){
        $member =Register::all();
        return response()->json([
            'status' =>200,
            'member' =>$member,
        ]);
    }
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required',
            'gender'=>'required',
            'dob' =>'required',
            'mobile'=>'required',
            'address'=>'required',
            'city' => 'required',
            'zip' =>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'errors' => $validator->errors()
            ],422);
        }

       $user =  new Register;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/students/', $filename);
            $user->image = $filename;
        }



               $user->name =$request->name;
               $user->email =$request->email; 
               $user->gender =$request->gender;
               $user->dob= $request->dob;
               $user->mobile = $request->mobile;
               $user->address = $request->address;
               $user->city = $request->city;
               $user->zip =$request->zip;
               $user->save();

        return response()->json([
            'message' => 'Succes',
            'errors' => $user
        ],200);
        

    }
    public function show($id){
        $member = Register::find($id);
        return response()->json([
            'status' =>200,
            'member' =>$member,
        ]);
    }
    public function update(Request $request,$id){
       
        $member = Register::find($id);
        if($member){    
            $member->name =$request->name;
            $member->email =$request->email; 
            $member->gender =$request->gender;
            $member->dob= $request->dob;
            $member->mobile = $request->mobile;
            $member->address = $request->address;
            $member->city = $request->city;
            $member->zip =$request->zip;
            $member->update();
            return response()->json([
                'status' =>200,
                'member' =>$member,
            ]);
        }
        else
        {
            return response()->json([
                'status' =>400,
                
            ]);
        }
    }
    public function delete($id){
        $member = Register::find($id);
        $member->delete();

    }
}
