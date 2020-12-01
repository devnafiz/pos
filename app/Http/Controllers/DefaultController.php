<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Supplier;
use App\Unit;
use App\Category;
class DefaultController extends Controller
{
    public function getCategory(Request $request){

    	$supplier_id=$request->supplier_id;
    	//dd($supplier_id);
    	$allCategory=Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();

          //dd($allCategory->toArray());

    	return response()->json($allCategory);
    }

    public function getProduct(Request $request){
    	$category_id=$request->category_id;
    	//dd($category_id);
    	$allProduct=Product::where('category_id',$category_id)->get();

         //dd($allCategory->toArray());

    	return response()->json($allProduct);
    }
    public function getStock(Request $request){

        //dd('ok');
        $product_id=$request->product_id;
        $stock=Product::where('id',$product_id)->first()->quantity;
        //dd($stock);
        return response()->json($stock);
    }
}
