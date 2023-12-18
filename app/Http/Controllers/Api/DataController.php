<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categorey;
use App\Models\SubCategorey;
use App\Models\Product;
use Illuminate\Support\str;



class DataController extends Controller
{
    public function addCategory(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'slug' =>'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'errors' => $validator->errors()
            ],422);
        }

       $user =  new Categorey;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/students/', $filename);
            $user->icon = $filename;
        }


               $user->name =$request->name;
               $slug = str::slug($request->name, '-');
               $user->slug =$slug; 
               $user->status =$request->status;
               $user->save();

        return response()->json([
            'message' => 'Succes',
            'data' => $user
        ],200);
        

    }
    public function index(){
        $member =Categorey::all();
        return response()->json([
            'status' =>200,
            'member' =>$member,
        ]);
    }
    public function update(Request $request, $id){
        $member = Categorey::find($id);
        if($member){    
            $member->name =$request->name;
            $member->slug =$request->slug;
            $member->status =$request->status; 
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
    public function addsubCategory(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'slug' =>'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'errors' => $validator->errors()
            ],422);
        }

       $user =  new SubCategorey;
               $user->name =$request->name;
               $slug = str::slug($request->name, '-');
               $user->slug =$slug; 
               $user->status =$request->status;
               $user->category_id =$request->parentcat;
               $user->save();

        return response()->json([
            'message' => 'Succes',
            'data' => $user
        ],200);
        

    }
    public function addProduct(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'category' =>'required',
            'sku' =>'required',
            'image'=>'required',
            'price'=>'required'
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'errors' => $validator->errors()
            ],422);
        }
        $user =  new Product;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $user->product_icon = $filename;
        }

        
    
        $images = $request->file('gallery');
        $imagearr = [];
        
        foreach ($images as $key => $image) {
            $imageName = time() . rand(1, 99) . '.' . $image->extension();  
            $image->move(public_path('images'), $imageName);
        
            $imagearr[] = $imageName;
        }
        
        $user->product_gallery = implode(',', $imagearr);
        

               $user->product_name =$request->name; 
               $user->category_id =$request->category;
               $user->subcategory_id =$request->subcat;
               $user->sku =$request->sku;
               $user->product_price =$request->price;
               $user->product_dprice =$request->dprice;
               $user->product_discount =$request->discount;
               $user->qty =$request->qty;
               $user->product_description =$request->description;
               $user->product_lquantity =$request->lquantity;
               $user->product_shipping =$request->shipping;
               $user->return =$request->return;
               $user->codstatus =$request->cod;
               $user->status =$request->status;
               $user->shiptime =$request->shiptime;

               $user->save();

        return response()->json([
            'message' => 'Succes',
            'data' => $user
        ],200);
    }
    public function showProduct(){
        $member =Product::all();
        return response()->json([
            'status' =>200,
            'member' =>$member,
        ]);

    }
    public function updateProduct(Request $request,$id){
        $user = Product::find($id);
        if($user){  

               $user->product_name =$request->name; 
               $user->category_id =$request->category;
               $user->subcategory_id =$request->subcat;
               $user->sku =$request->sku;
               $user->product_price =$request->price;
               $user->product_dprice =$request->dprice;
               $user->product_discount =$request->discount;
               $user->qty =$request->qty;
               $user->product_description =$request->description;
               $user->product_lquantity =$request->lquantity;
               $user->product_shipping =$request->shipping;
               $user->return =$request->return;
               $user->codstatus =$request->cod;
               $user->status =$request->status;
               $user->shiptime =$request->shiptime;
 
               $user->update();
            return response()->json([
                'status' =>200,
                'member' =>$user,
            ]);
        }
        else
        {
            return response()->json([
                'status' =>400,
                
            ]);
        }

        
    }
}
