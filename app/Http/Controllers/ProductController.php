<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Supplier;
use App\Unit;
use App\Category;

class ProductController extends Controller
{
     public function view(){


    //dd('ok');
     	$allData=Product::all();
     	return view('backend.product.view-product',compact('allData'));
     }


     public function add(){
         $suppliers=Supplier::all();
         $categories=Category::all();
         $units=Unit::all();
     	return view('backend.product.add-product',compact('suppliers','categories','units'));
     }

     public function store(Request $request){

     	$product=new Product;

     	$product->supplier_id=$request->supplier_id;
     	$product->category_id=$request->category_id;
     	$product->unit_id=$request->unit_id;
     	$product->name=$request->name;
     	$product->quantity='0';
     	
     	$product->created_by=Auth::user()->id;
     	$product->save();
     	return redirect()->route('products.view')->with('success','data save Successfully');
     }

     public function edit($id){

     	$data['editData']=Product::find($id);
         $data['suppliers']=Supplier::all();
         $data['categories']=Category::all();
         $data['units']=Unit::all();
     	//dd($editData);
     	return view('backend.product.edit-product',$data);
     }

     public function update(Request $request,$id){
     	$product=Product::find($id);

     	

     	$product->supplier_id=$request->supplier_id;
     	$product->category_id=$request->category_id;
     	$product->unit_id=$request->unit_id;
     	$product->name=$request->name;
     	$product->quantity='0';
     	
     	
     	$product->updated_by=Auth::user()->id;
     	$product->save();
     	return redirect()->route('products.view')->with('success','data updated Successfully');
     }

     public function delete($id){

     	$product=Product::find($id);

     	$product->delete();


     	return redirect()->route('products.view')->with('Success',' deleted Successfully!');
     }
}
